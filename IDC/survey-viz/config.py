import os

# Grabs the folder where the script runs.
basedir = os.path.abspath(os.path.dirname(__file__))

# Enable debug mode.
DEBUG = True
SECRET_KEY = 'treat if this helps you get started'

UPLOAD_FOLDER = os.path.join(basedir, "data")
ALLOWED_EXTENSIONS = set(['csv', 'json', 'pdf'])

MONGO_DBNAME = 'sviz'