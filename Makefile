init:
	php db/init.php

schema:
	dot -Tpng db/schema.dot -o schema.png

serve:
	php -S localhost:8080

os_cmd:
	./cmd/os_command_exploit.sh

pat_trv:
	./cmd/path_trav_exploit.sh

deploy:
	./cmd/deploy.sh

clean:
	find -type f -name 'schema.png' -delete
	find -type f -name '*.db' -delete
