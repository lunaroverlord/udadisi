# scrape tweets from topsy.com
 
import sys, urllib, urllib2, json, random
 
def search(query):
  data = {'q': query, 'type': 'tweet', 'perpage': 1000, 'mintime' : '1298988054', 'maxtime' : '1424268031', 'sort_method': "date", 'apikey': '09C43A9B270A470B8EB8F2946A9369F3'}
  url = "http://otter.topsy.com/search.js?" + urllib.urlencode(data)
  data = urllib2.urlopen(url)
  o = json.loads(data.read())
  res = o['response']
  return res
 
if __name__ == "__main__":
  try: tanya = str("#kot")
  except: print "python " + sys.argv[0] + " <query keyword>"
  print "> Querying for", tanya
  res = search(tanya)
  print "> Total fetched:", str(res['total'])
  print "> Here is the preview:"
  print res
  #for i in res['list'][:10]:
   # print "-->", i['firstpost_date'], i['title']
