# Returns Transfer Fees for Base Currency.
def transferFees(base):
    if base.split('_')[0]== 'ETH':
        return 0.005
    else:
        return 0.01


def checkBase(base):
    if base == 'BTC':
        return 'USDT_BTC'
    else:
        return 'USDT_ETH'