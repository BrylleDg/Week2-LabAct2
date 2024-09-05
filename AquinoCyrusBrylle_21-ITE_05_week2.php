<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
</head>
<body>
<?php
    class Book {
        public $title;
        protected $author;
        private $price;

        function __construct($title, $author, $price){
            $this->title = $title;
            $this->author = $author;
            $this->price = $price;
        }

        function getDetails(){
            return $this->title . " by " . $this->author . ", $" . $this->price;
        }

        function setPrice($price){
            $this->price = $price;
        }

        function __call($name, $arguments) {
            if ($name == 'updateStock') {
                return "Stock updated for '{$this->title}' with arguments: " . implode(', ', $arguments);
            }
    
            return "Method {$name} does not exist.";
        }

        function updatePrice($price) {
            $this->setPrice($price);
        }
    }

    class Library {
        private $books = []; 
        public $name;
    
        public function __construct($name) {
            $this->name = $name;
        }
    
        public function addBook(Book $book) {
            $this->books[$book->title] = $book;
        }
    
        public function removeBook($title) {
            if (isset($this->books[$title])) {
                unset($this->books[$title]);
                echo "Book '{$title}' removed from the library.<br>";
            } else {
                echo "Book titled '{$title}' not found in the library.<br>";
            }
        }
    
        public function listBooks() {
            if (empty($this->books)) {
                echo "No books available in the library.<br>";
            } else {
                foreach ($this->books as $book) {
                    echo $book->getDetails() . "<br>";
                }
            }
        }

        public function __destruct() {
            echo "The library '{$this->name}' is now closed.<br>";
        }
    }

    $book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", "12.99");
    $book2 = new Book("1984", "George Orwell", "8.99");

    $library = new Library("City Library");
    $library->addBook($book1);
    $library->addBook($book2);

    echo $book1->updateStock(50) . "<br>";

    echo "<h3>Books in the library:</h3>";
    $library->listBooks();
    $library->removeBook("1984");

    echo "<h3>Books in the library after removal:</h3>";
    $library->listBooks();

    unset($library); 
?>
</body>
</html>
