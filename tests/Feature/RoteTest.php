<?php

it('testa se qualquer usuario pode acessar a rota para visualizar o livro', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
