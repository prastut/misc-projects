from krakenex import *
k = API()
c = Connection()

a = k.query_public('Ticker', req={'pair': 'XXBTZUSD'})

print(a['result']['XXBTZUSD']['c'][0])