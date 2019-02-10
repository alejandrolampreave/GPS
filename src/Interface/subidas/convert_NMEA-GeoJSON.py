#!/usr/bin/env python 
# coding: utf-8
# In[76]:
'''
Script de Python que se encarga de la conversión de los mensajes NMEA recogidos
por la placa de desarrollo FDRMK64F al estándar GeoJSON necesario para la 
interpretación de la API de mapbox que muestra los mapas.
@author: Alejandro Fernández Lampreave
'''

import sys 
import requests
import re
miarchivo = sys.argv[1] 
url = 'https://mygeodata.cloud/api/convert'
files = {'file': open(miarchivo, 'rb')} 
data = {'format': 'geojson', 'outcrs': 'EPSG:4326', 'outform': 'binary', 'key': '5PsoGucmRRD2h0c'}
r = requests.post(url, files=files, data=data)
d = r.headers['content-disposition']
fname = re.findall("filename=(.+)", d)[0]
with open(fname, 'wb') as fd:
    for chunk in r.iter_content(1000):
        fd.write(chunk)