<?php



class DatabaseConnection
{
    protected string $host;
    protected string $admin;
    protected string $password;
    protected string $databaseName;
    private ?PDO $isDBconnected = null;


    public function __construct(string $databaseName, string $host = 'localhost', string $admin = 'root', string $password = '')
    {
        $this->host = $host;
        $this->admin = $admin;
        $this->password = $password;
        $this->databaseName = $databaseName;
    }

    public function connect(): PDO
    {
        if ($this->isDBconnected) {
            return $this->isDBconnected; 
        }

        try {
            $this->isDBconnected = new PDO(
                "mysql:host={$this->host};dbname={$this->databaseName}",
                $this->admin,
                $this->password
            );
            $this->isDBconnected->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->isDBconnected;
        } catch (PDOException $e) {
            throw new RuntimeException("Database connection failed: " . $e->getMessage());
        }
    }
}
