<?php
require_once("database.php");

$db = new Database();
$conn = $db->getConexao();

$stmt = $conn->prepare("SELECT id_medico, crm, nome_medico, especialidade FROM medico");
$stmt->execute();
$medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtem médico selecionado via GET
$medicoSelecionado = isset($_GET['medico_id']) ? $_GET['medico_id'] : null;

$mesAtual = isset($_GET['mes']) ? (int)$_GET['mes'] : date('n');
$anoAtual = 2025;
$primeiroDia = mktime(0, 0, 0, $mesAtual, 1, $anoAtual);
$nomeMes = strftime('%B', $primeiroDia);
$totalDias = date('t', $primeiroDia);
$diaSemana = date('w', $primeiroDia);

$stmtDisponiveis = $conn->prepare("SELECT DISTINCT data FROM horario_disponivel WHERE disponivel = 'sim' AND YEAR(data) = ? AND MONTH(data) = ?");
$stmtDisponiveis->execute([$anoAtual, $mesAtual]);
$datasVerdes = array_column($stmtDisponiveis->fetchAll(PDO::FETCH_ASSOC), 'data');

function formatarData($data) {
    return date('Y-m-d', strtotime($data));
}

$dataSelecionada = $_GET['dataSelecionada'] ?? '';
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <title>Agendamentos</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f5eaff;
            color: #6a0dad;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container, .section, .perfil-form {
            background: #e3d4ff;
            border-radius: 20px;
            padding: 20px;
            margin: 20px;
        }

        input, button, a {
            display: block;
            width: 80%;
            margin: 10px auto;
            padding: 10px;
            border: none;
            border-radius: 10px;
        }

        button {
            background: #9f4dff;
            color: white;
            font-weight: bold;
        }

        a {
            background: #b586ff;
            color: white;
            text-decoration: none;
            padding: 10px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            margin: 10px;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            max-width: 500px;
            margin: auto;
        }

        .day {
            padding: 10px;
            border-radius: 10px;
            background: #fff;
            cursor: pointer;
        }

        .available {
            background: #b2f2bb;
        }

        .selected-day {
            background: #ffd966 !important;
        }

        .selected-hour {
            background: #9f4dff !important;
            color: white;
            font-weight: bold;
        }

        .nav-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .nav-btn {
            padding: 10px 20px;
            background: #9f4dff;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .horarios {
            margin-top: 20px;
        }

        .weekday {
            font-weight: bold;
        }
    </style>
    <script>
        let dataSelecionada = '<?= $dataSelecionada ?>';
        let horarioSelecionado = '';

        function buscarHorarios(data) {
            dataSelecionada = data;
            const urlParams = new URLSearchParams(window.location.search);
            const mes = new Date(data).getMonth() + 1;
            const medico_id = urlParams.get("medico_id") || "";
            window.location.href = `?mes=${mes}&dataSelecionada=${data}&medico_id=${medico_id}`;
        }

        function selecionarHorario(hora) {
            horarioSelecionado = hora;
            document.getElementById('horaSelecionada').value = hora;

            // Remover seleções anteriores
            document.querySelectorAll('.horarios .day').forEach(el => el.classList.remove('selected-hour'));
            event.target.classList.add('selected-hour');

            verificarAgendamento();
        }

        function verificarAgendamento() {
            const medicoSelecionado = document.querySelector('input[name="medico_id"]:checked');
            const botaoConfirmar = document.getElementById('btnConfirmar');
            if (medicoSelecionado && dataSelecionada && horarioSelecionado) {
                botaoConfirmar.disabled = false;
            } else {
                botaoConfirmar.disabled = true;
            }
        }
    </script>
</head>
<body>
<div class='container'>
    <h2>Agende sua consulta!</h2>
    <?php if (count($medicos) > 0): ?>
    <form method='get' action=''>
        <?php foreach ($medicos as $medico): ?>
            <div class='card'>
                <strong>Nome:</strong> <?= htmlspecialchars($medico['nome_medico']) ?><br>
                <strong>CRM:</strong> <?= htmlspecialchars($medico['crm']) ?><br>
                <strong>Especialidade:</strong> <?= htmlspecialchars($medico['especialidade']) ?><br>
                <input type='radio' name='medico_id' value='<?= $medico['id_medico'] ?>'
                    <?= $medicoSelecionado == $medico['id_medico'] ? 'checked' : '' ?>
                    onchange='this.form.submit()'>
                <label>Agendar com este médico</label>
            </div>
        <?php endforeach; ?>
    </form>

    <h3>Calendário - <?= ucfirst(strftime('%B', $primeiroDia)) ?> 2025</h3>

    <div class='nav-buttons'>
        <a href="?mes=<?= max(1, $mesAtual - 1) ?>&medico_id=<?= $medicoSelecionado ?>">
            <button class='nav-btn'>&lt; Mês anterior</button>
        </a>
        <a href="?mes=<?= min(12, $mesAtual + 1) ?>&medico_id=<?= $medicoSelecionado ?>">
            <button class='nav-btn'>Próximo mês &gt;</button>
        </a>
    </div>

    <div class='calendar'>
        <div class='weekday'>Dom</div><div class='weekday'>Seg</div><div class='weekday'>Ter</div>
        <div class='weekday'>Qua</div><div class='weekday'>Qui</div><div class='weekday'>Sex</div><div class='weekday'>Sab</div>
        <?php
        for ($i = 0; $i < $diaSemana; $i++) echo "<div></div>";
        for ($dia = 1; $dia <= $totalDias; $dia++) {
            $dataCompleta = date('Y-m-d', mktime(0, 0, 0, $mesAtual, $dia, $anoAtual));
            $classe = in_array($dataCompleta, array_map('formatarData', $datasVerdes)) ? 'day available' : 'day';
            if ($dataSelecionada == $dataCompleta) {
                $classe .= ' selected-day';
            }
            echo "<div class='$classe' onclick='buscarHorarios(\"$dataCompleta\")'>$dia</div>";
        }
        ?>
    </div>

    <div id='horarios' class='horarios'>
        <?php
        if ($dataSelecionada) {
            $stmtHorarios = $conn->prepare("SELECT hora FROM horario_disponivel WHERE data = ? AND disponivel = 'sim' ORDER BY hora");
            $stmtHorarios->execute([$dataSelecionada]);
            $horarios = $stmtHorarios->fetchAll(PDO::FETCH_COLUMN);

            echo "<h3>Horários disponíveis para $dataSelecionada:</h3>";
            if ($horarios) {
                foreach ($horarios as $hora) {
                    echo "<div onclick=\"selecionarHorario('$hora')\" class='day'>$hora</div>";
                }
            } else {
                echo "<p>Nenhum horário disponível nesta data.</p>";
            }
        }
        ?>
    </div>

    <form method='post' action='Consultas.php'>
        <input type='hidden' name='medico_id' value='<?= htmlspecialchars($medicoSelecionado) ?>'>
        <input type='hidden' name='data' value='<?= htmlspecialchars($dataSelecionada) ?>'>
        <input type='hidden' name='hora' value='' id='horaSelecionada'>
        <button type='submit' id='btnConfirmar' disabled>Confirmar Agendamento</button>
    </form>
    <?php else: ?>
        <p>Nenhum médico disponível no momento.</p>
    <?php endif; ?>

    <a href='home.php'>Página inicial</a>
</div>

<script>
    document.getElementById('btnConfirmar')?.addEventListener('click', function () {
        document.getElementById('horaSelecionada').value = horarioSelecionado;
    });
</script>
</body>
</html>
