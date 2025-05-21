<?php

$agendamentoDisponiveis = [
    1 => [
        'nome' => '<b>Consulta com Mastologista</b>',
        'especialidade' => 'Mastologista',
        'responsavel' => 'Dra. Thaynara',
        'local' => 'Clínica-Saude X',
        'horario' => '10:30',
        'tipo' => 'Consulta'
    ],
    2 => [
        'nome' => '<b>Exame de Mamografia</b>',
        'especialidade' => 'Exame de Radiologico',
        'responsavel' => 'Dr. Thiago',
        'local' => 'Clinica-Azul',
        'horario' => '12:00',
        'tipo' => 'exame'
    ],
];

echo "<h2>Visualizar Exame</h2>";

if (isset($_POST['agendamento_id'])) {
    $idSelecionado = $_POST['agendamento_id'];

    if (isset($agendamentoDisponiveis[$idSelecionado])) {
        $exameSelecionado = $agendamentoDisponiveis[$idSelecionado];

        echo "<h3>Detalhes do Exame Selecionado:</h3>";
        echo "<pre>";
        foreach ($exameSelecionado as $chave => $valor) {
            echo "<strong>" . ucfirst($chave) . ":</strong> " . $valor . "\n";
        }
        echo "</pre>";

    } else {
        echo "<p>Erro: Opção de agendamento inválida.</p>";
    }
} else {
    echo "<p>Nenhum exame foi selecionado.</p>";
}
echo "<p><a href='Agendamento.php'>Agendar sua consulta</a></p>";

?>