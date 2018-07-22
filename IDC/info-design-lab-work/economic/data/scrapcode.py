import urllib, urlparse

testfile = urllib.URLopener()

baseUrl = "http://indiabudget.nic.in/tab2012/"

for i in range(300):
	string = ''
	string = 'tab' + "%02d" % (i) + '.xls'
	
	url = urlparse.urljoin(baseUrl,string)
	
	try:
		testfile.retrieve(url, string)	
	except Exception as e:
		print i
