<?php
/*Tela exames
5-Tela de consultas
6-Tela de marcar as consultas(agendamento)
7-Resultado dos exames*/

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

echo "<h2>Agende sua consulta ou exame!</h2>";
echo "<p>Selecione a opção desejada:</p>";

echo "<form method='post' id='agendamentoForm'>";
echo "<div style='display: flex; flex-direction: row; gap: 100px;'>";

foreach ($agendamentoDisponiveis as $id => $detalhes) {
    echo "<div>";
    echo "<h3>" . $id . "</h3>";
    foreach ($detalhes as $chave => $valor) {
        echo "<strong>" . ucfirst($chave) . ":</strong> " . $valor . "<br>";
    }
    echo "<input type='radio' name='agendamento_id' value='" . $id . "' id='opcao_" . $id . "'>";
    echo "<label for='opcao_" . $id . "'>Agendar</label>";
    echo "</div>";
}
echo "</div><br>";
echo "<br>";
echo "<button type='submit'>Confirmar Agendamento</button>";
echo "</form>";

echo "<script>
    document.getElementById('agendamentoForm').addEventListener('submit', function(event) {
        const selectedOption = document.querySelector('input[name=\"agendamento_id\"]:checked');
        if (selectedOption) {
            const selectedId = selectedOption.value;
            const agendamentos = " ($agendamentoDisponiveis) . ";
            if (agendamentos[selectedId] && agendamentos[selectedId]['tipo'] === 'Consulta') {
                this.action = 'Consultas.php';
            } else if (agendamentos[selectedId] && agendamentos[selectedId]['tipo'] === 'exame') {
                this.action = 'Exames.php';
            } else {
                event.preventDefault();
            }
        } else {
            event.preventDefault();
            alert('Por favor, selecione uma opção.');
        }
    });
</script>";
echo "<p><a href='Consultas.php'>Verificar suas consultas</a></p>";
echo "<p><a href='Exames.php'>Verificar seus exames</a></p>";
?>