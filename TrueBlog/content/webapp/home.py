#!/usr/bin/env python
import time
from mod_python import Cookie


def index(req):
    req.content_type = "text/html"
    html = open("/var/www/html/templates/home.html").read()
    cookie_string = "False, RmFsc2U="
    cookie = Cookie.Cookie("admin", cookie_string)
    timestamp = time.time() + 300
    cookie.expires = timestamp
    Cookie.add_cookie(req, cookie)
    req.write(html)
