## Описание API

#### Authors

**GET /authors** - возвращает список авторов;

**GET /authors/{author_id}** - возвращает автора;

**GET /authors/{author_id}/books** - возвращает список книг конкретного автора;

**POST /authors** - добавляет нового автора;

Пример запроса: {"author_name" : "Dan Brown"}

**PUT /authors/{author_id}** - изменяет данные автора (имя);

Пример запроса: {"author_name" : "Ден Браун"}

**DELETE /authors/{author_id}** - удаляет автора из базы;

#### Books

**GET /books** - возвращает полный список книг;

**GET /books/{book_id}** - возвращает книгу;

**POST /books** - добавляет новую книгу, связывает ее с автором;

Пример запроса: {"book_name" : "Da Vinci Code", "author_id" : 1}

**PUT /books/{book_id}** - изменяет данные книги (название и принадлежность к автору);

Пример запроса: {"book_name" : "Код Да Винчи", "author_id" : 2}

**DELETE /books/{book_id}** - удаляет книгу из базы;

### Замечания

Для удобства тестирования проверка CSRF токена отключена для всех роутов кроме POST. Для POST не нашел способа отключить, поэтому нужно передавать его в заголовках запроса:

{"X-CSRF-TOKEN": "1rzdKkOxhn7ZxeOPSaZECKqL0iRxbt5kliRF0vPK"}


