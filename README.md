# kicky_wiki

## 環境構築
```
git clone https://github.com/kshiva1126/kicky_wiki.git

docker-compose up -d --build

docker-compose exec app composer install

docker-compose exec app npm install

docker-compose exec app npm run development

必要に応じてパーミッション変更

access to http://localhost:3500/

```

## 使用技術
- インフラ(開発環境はdockerで構築)
    - Webサーバ: nginx
    - DB: MySQL
- サーバ
    - Laravel
- クライアント
    - Vue.js
    - Sass
    - BootStrap 4
    - Font Awesome 5