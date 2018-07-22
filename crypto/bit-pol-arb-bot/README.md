# cryto-bot

## Installation:

Note these scripts use Python2.7. 

* Install Poloniex Python Wrapper: https://github.com/s4w3d0ff/python-poloniex
* Install Bittrex Python Wrapper: https://github.com/ericsomdahl/python-bittrex
* `pip install requests openpyxl`

* Place the keys file under `helper` directory named as keys.py in the following format:

  ```
  bit = {
      'key': '',
      'secret': ''
  }

  pol = {
      'key': '',
      'secret': ''

  }
  ```

## Files Documentation:

Currently have split the code into 2 scripts. One spits out all the margins (general), second is used for entering a specific trade. Design Decision: just to be careful. 

* `logs-general-trading.py` - runs on all currencies that are supported by Bittrex and Poloniex and spits out the margin. Also creates excel files in log folder. 
  * To run `python logs-general-trading.py`
* `trading-specific.py` - runs on the specific currency you enter.
  * To run `python trading-specific.py ETH_GNT`









