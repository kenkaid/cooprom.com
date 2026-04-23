<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Protection contre l'utilisation de la base de données de production pendant les tests
        // On vérifie si on est sur la connexion mysql ET si le nom de la base est 'cooprom'
        if (config('database.default') === 'mysql' && config('database.connections.mysql.database') === 'cooprom') {
            throw new \Exception('DANGER : Les tests tentent d\'utiliser la base de données de production "cooprom". Opération bloquée par sécurité.');
        }

        // Sécurité supplémentaire : On interdit RefreshDatabase sur autre chose que sqlite ou une DB de test dédiée
        // Si RefreshDatabase est utilisé, Laravel essaiera de migrer/rafraîchir.
        // On s'assure que si on n'est pas en sqlite, le nom de la base contient au moins 'test'
        if (config('database.default') !== 'sqlite' && !str_contains(config('database.connections.' . config('database.default') . '.database'), 'test')) {
             // On laisse passer si c'est sqlite (souvent :memory:)
             // Sinon, on bloque si le nom de la DB ne contient pas 'test'
             if (config('database.default') !== 'sqlite') {
                 throw new \Exception('DANGER : Les tests ne peuvent être lancés que sur SQLite ou une base de données dont le nom contient "test".');
             }
        }
    }
}
