import requests
from bs4 import BeautifulSoup
import openpyxl
import xlrd
import csv
import re



page = requests.get("http://indiabudget.nic.in/statdata.asp?pageid=1")
soup = BeautifulSoup(page.content, 'html.parser')



matchscrap = soup.find_all('a')

print matchscrap