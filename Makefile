init:
	php db/init.php

schema:
	dot -Tpng db/schema.dot -o schema.png

serve:
	php -S localhost:8080

clean:
	find -type f -name 'schema.png' -delete
	find -type f -name '*.db' -delete
