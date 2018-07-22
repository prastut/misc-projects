## Survey Viz

Project Structure
--------

  ```sh
  ├── README.md
  ├── app.py
  ├── config.py
  ├── error.log
  ├── requirements.txt
  ├── data
  ├── static
  │   ├── css
  │   ├── font
  │   ├── ico
  │   ├── img
  │   └── js
  └── templates
      ├── errors
      │   ├── 404.html
      │   └── 500.html
      ├── forms
      │   ├── forgot.html
      │   ├── login.html
      │   └── register.html
      ├── layouts
      │   ├── form.html
      │   └── main.html
      └── pages
          ├── placeholder.upload.html
          └── placeholder.home.html
      
  ```


### Quick Start

1. Clone the repo
  ```
  $ git clone https://github.com/prastut/survey-viz
  $ cd survey-viz
  ```

3. Install the dependencies:
  ```
  $ pip install -r requirements.txt
  ```
  
4. Make a `data` folder (This is the folder where your uploads are going to be stored)
  ```
  $ mkdir data
  ```

5. Run the development server:
  ```
  $ python app.py
  ```

6. Navigate to [http://localhost:5000](http://localhost:5000)

