
![Logo](https://www.leow.live/gitlogoup.png)


# CDN Rest API

This project creates REST Api for secured upload and download of files from remote server. 

This solution allows multiple users to upload files without file names overlaping and prevent access to files that are not owned by specific user.

Thanks to token auth and storage with random names it provides security and decreases possibility of breaches. 

It is coded in PHP with addition of MySQL. It has no frontend but in package it will Web Admin Panel. 

See below for ussage and MySQL table structure. 



## API Ussage/Reference

#### Download file

```http
  GET https://cdn.leow.live/
  GET https://cdn.leow.live/index.php
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `token` | `string` | **Required**. Your token, generated with order |
| `file` | `string` | **Required**. the name of file you have uploaded with extension. (eg. file.txt) |

#### Use example

```http
  GET https://cdn.leow.live/?token=xxxxxxxxxx&file=name.txt
```


#### Upload file

```http
  POST https://cdn.leow.live/upload.php/
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token` | `string` | **Required**. Your token, generated with order |
| `file` | `Body/Form Data - Key [file]` | **Required**. Attached file you want to upload |

#### Use example

```http
  curl --location --request POST 'https://cdn.leow.live/upload.php?token=xxxxxxxxxx' --form 'file=@"/C:/Users/location/to/file.txt"'
```


## JSON responses
This section describes types of responses you can get from api when using it. 
### Errors in index.php,upload.php,get_file.php

#### Failure: token_not_provided


````JSON
{
    "get_status": "failure",
    "token_provided": "null",
    "file": "not_checked",
    "error_code": "token_not_provided",
    "error_details": "Token was not provided in the request"
}
````

* This error occures when the **GET request sent without token** authentication. It will not check if the file was selected.
* This error can occure if the **request was sent with POST**.

#### Failure: file_not_provided

````JSON
{
    "get_status": "failure",
    "token_provided": "xxxxxxxxx",
    "file_name": "null",
    "error_code": "file_not_provided",
    "error_details": "File name was not provided in the request"
}
````

* This error occures when the **GET request is sent without file name which you want to download**.
* This error can occure if the **request was sent with POST**.

#### Failure: mysql_failure

````JSON
{
    "get_status": "failure",
    "token_provided": "xxxxxxxxx",
    "file_name": "xxxx.xx",
    "error_code": "mysql_failure",
    "error_details": "*Depends on situatuon*"
}
````

* This error occures when the **connection to the database was not successfull**.
* This can occur due to multiple factors, please **check error details for more information**. 
* **If you purchased the package contact us immidiately!**


#### Failure: token_invalid

````JSON
{
    "get_status": "failure",
    "token_provided": "xxxxxxxxx",
    "file_name": "xxxx.xx",
    "error_code": "token_invalid",
    "error_details": "Provided token does not exist in our database"
}

````

* This error occures when **token you have is not registered in out database**.
* Remember if you have not purchased a package with us you will not be able to use any token.
* **If you purchased the package contact us immidiately!**

#### Failure: query_failed

````JSON
{
    "get_status": "failure",
    "token_provided": "xxxxxxxxx",
    "file_name": "xxxx.xx",
    "error_code": "query_failed",
    "error_details": "MYSQL on our side could not fetch query from the database. Contact the admin."
}

````

* This error occures when the connection to database failes to get information. 
* **If you purchased the package contact us immidiately!**

#### Failure: file_does_not_exist

````JSON
{
    "get_status": "failure",
    "token_provided": "xxxxxxxxx",
    "file_name": "xxx.xx",
    "error_code": "file_does_not_exist",
    "error_details": "Provided file does not exist on our server"
}

````

* This error occures when you try to download file you have never uploaded.

#### Failure: file_not_present

````JSON
{
    "get_status": "failure",
    "token_provided": "xxxxxxxxx",
    "file_name": "xxxx.xx",
    "error_code": "file_not_present",
    "error_details": "You have not uploaded any file."
}

````

* This error occures when you try to upload **file that have not been attached to the POST request**.


#### Success: upload_successfull

````JSON 
{
    "get_status": "success",
    "token_provided": "d41d8cd98f00b204e9800998ecf8427e",
    "file_name": "sea-of-dreamscape-r4-1920x1200.jpg",
    "success_code": "upload_successfull"
}

````

* The file was successfuly uploaded and now you can access it after .1s from our servers. 
## Features

- Quick Server Reply
- 99.9% uptime with planned downtimes every sunday 23.30-23.35 GMT+2
- ASync processing (planned)
- GET/POST request handling
- Admin panel included in package


## Tech Stack

**Server:** PHP 7.2.4+ (Tested on PHP 7.2.4)


## Roadmap

- Add multiserver/cluster support

- Integrate with admin panel

- fix issues


## Authors

- [@xXleowXx](https://github.com/xXleowXx)

