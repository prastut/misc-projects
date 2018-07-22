import grequests
import time
import datetime
import time
import openpyxl
import xlrd
import csv
import requests



urls = [
    'https://poloniex.com/public?command=returnTicker',
]

r = requests.post('https://poloniex.com/tradingApi', data = {'key':'WC1XTYN1-8A0PUQ5F-QOX3RG1F-P4MIZFNL'})