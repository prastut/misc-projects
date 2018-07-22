from flask import *
import requests, urllib, json
from urlparse import * 
from collections import OrderedDict
import unicodedata


r = None
params = {}

app = Flask(__name__)

def call(params):
    r = requests.get("https://www.google-analytics.com/r/collect", params=params)
    print 1
    return r.text



@app.route("/", methods=['GET', 'POST'])
def hello():
    url = "https://www.google-analytics.com/r/collect?v=1&_v=j54&a=228126134&t=pageview&_s=1&dl=http%3A%2F%2Fprastutkumar.design%2F&ul=en-us&de=UTF-8&dt=Prastut%20Kumar&sd=24-bit&sr=1440x900&vp=1063x803&je=0&fl=25.0%20r0&_u=IADAAEABI~&jid=782486928&gjid=1619743366&cid=1199804793.1488915886&tid=UA-82835468-1&_gid=741740086.1495134765&_r=1&z=148612359"
     
    return render_template('index.html', url=url)

@app.route("/changeparams", methods=['GET', 'POST'])
def changeparams():
    global params
    path = request.form['input']
    path = path.encode('utf-8')
    params = parse_qsl(urlparse(path).query)

    return render_template('table.html', url=path, params=params)


@app.route("/letshit",methods=['GET', 'POST'])
def letshit():
    global params

    hdr = {'User-Agent': 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11',
       'Accept-Encoding': 'gzip, deflate, sdch, br',
       'Accept-Language': 'en-US,en;q=0.8,nl;q=0.6',
       'Connection': 'keep-alive',
       'save-data': 'on',
       'accept': 'image/webp,image/*,*/*;q=0.8',
       'referer': 'http://prastutkumar.design',
    }

    newparams = {}
    for key,value in params:
        temp = request.form[key]
        temp = temp.encode('utf-8')
        newparams[key] = temp
    
    r = call(params)

    return render_template('result.html', result=r)

@app.route("/letshitagain",methods=['GET', 'POST'])
def letshitagain():
    r = call(params)
    return render_template('result.html', result=r)





if __name__ == '__main__':
    app.run(debug=True)