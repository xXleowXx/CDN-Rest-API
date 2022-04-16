# CDN-file-accesser

This api allows for secured access to files with authentication and multiuser storage in one folder. Secured from other users being able to access the file. 

Thanks to token auth and storing the files in random names, different user can store the file with the same name without overwriting others work.


MYSQL tables:

access

| id | token | username |
| :---         |     :---:      |          ---: |
| 1  | xxxxxxxxx     | xxxxxxx    |

file_db
  
| id | file_nam | file_name_storage | owner_id |
| :---         |     :---:      |     :---:      |         ---: |
| 1  | somefilename.exe  | randomly generated name    | x    |




File Stucture

assume base /var/www/html/  
index.php will be in /var/www/html/cdn/cdn/index.php  
files will be stored in /var/www/html/cdn/some_random_generated_file_name (remember to add .htaccess deny from all to that folder)  


https://ip.domain/?token=xxxxx&file="xxx.xx"  


ToDo:  
Add upload option, as currently there is no way to imput files to the system automatically.   
