<?php

$resultadosExames = [
    1 => [
        'nome_paciente' => 'Ana Silva',
        'exame' => 'Mamografia',
        'data_realizacao' => '05/05/2025',
        'resultado' => 'Sem alterações significativas.',
        'observacoes' => 'Recomendado acompanhamento anual.'
    ],

];

echo "<h2>Resultados de Exames</h2>";

if (!empty($resultadosExames)) 
	{
    foreach ($resultadosExames as $id => $resultado) 
		{
        echo "<h3>Resultado do Exame #" . $id . "</h3>";
        echo "<p><strong>Nome do Paciente:</strong> " . $resultado['nome_paciente'] . "</p>";
        echo "<p><strong>Exame:</strong> " . $resultado['exame'] . "</p>";
        echo "<p><strong>Data de Realização:</strong> " . $resultado['data_realizacao'] . "</p>";
        echo "<p><strong>Resultado:</strong> " . $resultado['resultado'] . "</p>";
        echo "<p><strong>Observações:</strong> " . $resultado['observacoes'] . "</p>";
		}
	}
 else {
    echo "<p>Nenhum resultado de exame disponivel no momento.</p>";
}
    echo "<p><a href='Agendamento.php'>Voltar para Agendamento</a></p>";
	
?>