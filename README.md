Rodar no terminal:
   composer install
   npm install
   npm run build
   php artisan migrate (Confirme a cria��o do novo banco)
   php artisan db:seed
   php artisan key:generate

Editar o arquivo .env para a conex�o
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=autogestormatheus
   DB_USERNAME=root
   DB_PASSWORD=123456


Usuarios criados: 
   admin@example.com -> Somente acesso ao painel admin

   produtos@example.com
   categorias@example.com
   marcas@example.com
   gerente@example.com

   a senha de todos ficou 12345