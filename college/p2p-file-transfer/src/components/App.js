import Bootstrap from './Bootstrap'
import ErrorPage from './ErrorPage'
import FrozenHead from 'react-frozenhead'
import React from 'react'
import SupportStore from '../stores/SupportStore'
import { RouteHandler } from 'react-router'
import ga from 'react-google-analytics'

ga('create', 'UA-62785624-1', 'auto');
ga('send', 'pageview');

export default class App extends React.Component {

  constructor() {
    super()
    this.state = SupportStore.getState()

    this._onChange = () => {
      this.setState(SupportStore.getState())
    }
  }

  componentDidMount() {
    SupportStore.listen(this._onChange)
  }

  componentWillUnmount() {
    SupportStore.unlisten(this._onChange)
  }

  render() {
    return <html lang="en">
      <FrozenHead>

        <meta charSet="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"></link>
        <title>P2P File Transfer</title>

        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Quicksand:300,400,700|Lobster+Two" />
        <link rel="stylesheet" href="/app.css" />

        <Bootstrap data={this.props.data} />
        <script src="https://cdn.jsdelivr.net/webtorrent/latest/webtorrent.min.js" />
        <script src="/app.js" />

      </FrozenHead>

      <body>
        <div className="container">
          {this.state.isSupported
            ? <RouteHandler />
            : <ErrorPage />}
        </div>
        <footer className="footer">

          <p className="byline">
           By <a href="https://avisrivastava254084.github.io/">Aviral Srivasata</a>,<a href="http://patelfenil.github.io" target="_blank"> Fenil Patel, </a> &amp; <a href="http://prastut.github.io" target="_blank">Prastut Kumar</a>.
          </p>
        </footer>
        <script>FilePizza()</script>
        <ga.Initializer />
      </body>
    </html>
  }

}
