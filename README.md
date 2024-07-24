# Projetc SIGAC in LARAVEL

Um site em desenvolvimento para estudo de laravel da aula de Desenvolvimento de Web II

# Como usar

- Instale a versão mais atual do ```XAMPP```
- Instale a versão mais recente do ```COMPOSER```
- Ligue o ```MySQL``` e ```Apache``` do xampp
- Copie o ```.env.example``` e deixe apenas com o nome ```.env``` e insira os seus dados do banco
- No seu banco local crie uma database com o nome que você irá inserir no .env
- Faça as migrations, ```php artisan migrate:fresh --seed``` para seu banco
- Dê ```php artisan serve``` e abra seu código