#!/usr/bin/env python
# -*- coding: utf-8 -*-

import MySQLdb

from bottle import route, run, template, response
from json import dumps
from pprint import pprint

connector = MySQLdb.connect(host="localhost", db="sample", user="root", passwd="", charset="utf8")
cursor = connector.cursor(MySQLdb.cursors.DictCursor)

@route('/')
def index():
	return "hello, bottle!"

@route('/hello/:name')
def index(name='World'):
    return template('<b>Hello {{name}}</b>!', name=name)

@route('/api')
def index():
	cursor.execute("SELECT spot.*, prefecture.name AS prefecture_name FROM spot LEFT JOIN prefecture ON spot.prefecture_id = prefecture.id ORDER BY id DESC LIMIT 10")
	rows = cursor.fetchall()
	response.content_type = 'application/json'
	return dumps(rows)

run(host='localhost', port=9005)


