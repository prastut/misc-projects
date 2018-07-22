from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from bs4 import BeautifulSoup
import re
import time

# Setup Config
payload = {
    "email": "<your email here>",
    "password": "<your password here>",
}

index_link = "<index link>"


# Only touch if you know what are you doing
register_link = "http://lamscommunity.org/register"
download_link = index_link + "dl?seq_id="

driver = webdriver.Chrome()

# Login
driver.get(register_link)

username = driver.find_element_by_id("email")
password = driver.find_element_by_id("password")

username.send_keys(payload['email'])
password.send_keys(payload['password'])

driver.find_element_by_name("formbutton:ok").click()

# Login Done. Index Page Scraping Start
driver.get(index_link)

lastHeight = driver.execute_script("return document.body.scrollHeight")
pause = 0.5

while True:
    driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
    time.sleep(pause)
    newHeight = driver.execute_script("return document.body.scrollHeight")
    if newHeight == lastHeight:
        break
    lastHeight = newHeight
    

soup = BeautifulSoup(driver.page_source, 'html.parser')


odd = soup.find_all('tr', class_='list-odd')
even = soup.find_all('tr', class_='list-even')

urlslist = []

for o in odd:
    urlslist.append(o.find_all('a')[0]['href'].split('=')[1])

for e in even:
    urlslist.append(e.find_all('a')[0]['href'].split('=')[1])

urlsfinal = list(set(urlslist))

print len(urlsfinal)


# Index Page Scraped for download ID. Now download starts. 

for obj in urlsfinal:
    print obj
    driver.get(download_link + obj)
    driver.find_element_by_name("submit").click()

# driver.close()
