#!/usr/bin/env python
# coding: utf-8

# In[71]:


import requests
import re
url = 'https://mygeodata.cloud/api/convert'
files = {'file': open('LOG_GPS_NMEA.txt', 'rb')}
data = {'format': 'geojson', 'outcrs': 'EPSG:4326', 'outform': 'binary', 'key': '5PsoGucmRRD2h0c'}
r = requests.post(url, files=files, data=data)
d = r.headers['content-disposition']
fname = re.findall("filename=(.+)", d)[0]
with open(fname, 'wb') as fd:
    for chunk in r.iter_content(1000):
        fd.write(chunk)

