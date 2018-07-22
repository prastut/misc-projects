# Download LAMS Community Scripts

Downloads community scripts from [lams community](http://lamscommunity.org/register/?return_url=%2fdotlrn%2findex). Uses Python 2.7, Selenium + Chrome, bs4.

## Setup

* Install dependencies by `pip install -r requirements.txt`.
* Fill in payload details inside `scrap.py`

  * Enter your LAMS credentials inside `payload`
  * Enter the index of the category of LAMS script you want to scrap. Eg: if you wanted to scrap of all scripts under K-12 links then `index_link = http://lamscommunity.org/dotlrn/clubs/educationalcommunity/k12schools//lams-seq/`

* Run scrapper by `python scrap.py`
