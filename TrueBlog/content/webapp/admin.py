#!/usr/bin/env python
import time
from jinja2 import Template
from mod_python import Cookie


def index(req):
    req.content_type = "text/html"
    html = open("/var/www/html/templates/admin.html").read()
    t = Template(html)
    cookie = Cookie.get_cookie(req, "admin")
    if cookie:
        if str(cookie.value) == "True, VHJ1ZQ==":
            req.write(t.render(text=open("/opt/flag.txt").read()))
        else:
            req.write(t.render(text="LOL get out you are not the admin!"))
    else:
        req.write(t.render(text="LOL get out you are not the admin!"))
