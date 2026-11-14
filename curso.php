<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo_pagina = "Curso – Salta de Mates";

$mensaje_quiz = "";
$tipo_alerta_quiz = "";
$mis_intentos = [];

// Conectar a la base de datos para registrar o consultar respuestas del Quiz
if (file_exists('config/conexion.php')) {
    try {
        require_once 'config/conexion.php';

        // Procesar formulario del Quiz
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_quiz'])) {
            if (!isset($_SESSION['usuario_id'])) {
                $mensaje_quiz = "⚠️ Para rendir el cuestionario y guardar tu calificación en la base de datos, debes <a href='login.php' style='color:#1e7a3e; font-weight:bold;'>iniciar sesión</a> o <a href='registro.php' style='color:#1e7a3e; font-weight:bold;'>crear tu cuenta</a>.";
                $tipo_alerta_quiz = "warning";
            } else {
                $p1 = $_POST['p1'] ?? '';
                $p2 = $_POST['p2'] ?? '';
                $p3 = $_POST['p3'] ?? '';

                if (empty($p1) || empty($p2) || empty($p3)) {
                    $mensaje_quiz = "⚠️ Por favor, responde las 3 preguntas antes de enviar.";
                    $tipo_alerta_quiz = "danger";
                } else {
                    $aciertos = 0;
                    if ($p1 === 'b') $aciertos++; // 70-80 °C
                    if ($p2 === 'b') $aciertos++; // no quiere más
                    if ($p3 === 'a') $aciertos++; // Ilex paraguariensis

                    // Escala de calificación sobre 10
                    $notas = [0 => 2, 1 => 4, 2 => 7, 3 => 10];
                    $nota_final = $notas[$aciertos] ?? 0;
                    $estado = ($nota_final >= 6) ? 'Aprobado' : 'Desaprobado';

                    // Guardar en MySQL con Consulta Preparada (Anti SQL Injection)
                    $sql = "INSERT INTO respuestas_quiz (usuario_id, puntaje, nota_sobre_10, estado) 
                            VALUES (:uid, :puntaje, :nota, :estado)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':uid'     => $_SESSION['usuario_id'],
                        ':puntaje' => $aciertos,
                        ':nota'    => $nota_final,
                        ':estado'  => $estado
                    ]);

                    if ($estado === 'Aprobado') {
                        $mensaje_quiz = "🎉 ¡Felicitaciones, " . htmlspecialchars($_SESSION['usuario_nombre']) . "! Aprobaste con nota: <strong>" . $nota_final . "/10</strong> (" . $aciertos . " de 3 aciertos). Tu resultado quedó registrado en la base de datos.";
                        $tipo_alerta_quiz = "success";
                    } else {
                        $mensaje_quiz = "📝 Obtuviste nota: <strong>" . $nota_final . "/10</strong> (" . $aciertos . " de 3 aciertos). Estado: <em>" . $estado . "</em>. Puedes repasar los módulos y volver a intentarlo.";
                        $tipo_alerta_quiz = "info";
                    }
                }
            }
        }

        // Consultar intentos previos del usuario actual
        if (isset($_SESSION['usuario_id'])) {
            $stmt_hist = $pdo->prepare("SELECT * FROM respuestas_quiz WHERE usuario_id = :uid ORDER BY id DESC LIMIT 5");
            $stmt_hist->execute([':uid' => $_SESSION['usuario_id']]);
            $mis_intentos = $stmt_hist->fetchAll();
        }

    } catch (\Exception $e) {
        // En caso de que la BD no esté disponible
    }
}

require_once 'includes/header.php';
?>

  <div class="page-hero">
    <h1>🧉 Curso: El Arte del Mate en Salta</h1>
    <p>Aprendé la cultura, historia y rituales del mate en el noroeste argentino. 100% en línea.</p>
  </div>

  <main class="container">

    <h1>Guía de Estudio en Línea</h1>
    <p>Esta guía está organizada en módulos. Seguila de forma secuencial para mejores resultados.</p>

    <!-- MÓDULO 1 -->
    <div class="card-blanco">
      <h2>Módulo 1 — Historia del Mate</h2>

      <h3>1.1 Origen del mate</h3>
      <p>El mate es una infusión originaria de los pueblos guaraníes, extendida luego por toda América del Sur. En Salta su consumo tiene características propias ligadas a la cultura andina.</p>

      <div>
        <h4>Conceptos clave</h4>
        <ul>
          <li>La Ilex paraguariensis: planta base del mate</li>
          <li>Expansión colonial y adopción criolla</li>
          <li>El mate en las culturas andinas del NOA</li>
        </ul>

        <h5>Lectura recomendada</h5>
        <p>Andrade, M. (2021): <em>Mate, identidad y territorio.</em> UNSa Editorial.</p>

        <h6>Actividad práctica</h6>
        <p>Investigá el origen del mate en tu región y compartilo en el foro del curso.</p>
      </div>

      <h3>1.2 El mate en Salta</h3>
      <p>La tradición salteña incorpora el mate en la vida cotidiana, en reuniones familiares, plazas y mercados. Su preparación varía según el municipio.</p>

      <div>
        <h4>Variantes locales</h4>
        <ul>
          <li>Mate cocido con leña de quebracho</li>
          <li>Mate con hierbas serranas (muña muña, cedrón)</li>
          <li>Matero: el rol social del que prepara y ceba</li>
        </ul>
        <h5>Video de apoyo</h5>
        <p>Disponible en el campus: "El mate salteño de plaza en plaza" — 18 min.</p>
      </div>
    </div>

    <!-- MÓDULO 2 -->
    <div class="card-blanco">
      <h2>Módulo 2 — Los Mejores Lugares para Matear</h2>

      <h3>2.1 Cómo elegir un buen rincón</h3>
      <p>No cualquier lugar es ideal: la sombra, la tranquilidad y el acceso al agua caliente son factores clave.</p>

      <h4>Criterios de selección</h4>
      <ul>
        <li>Entorno natural o cultural atractivo</li>
        <li>Disponibilidad de sombra en verano</li>
        <li>Accesibilidad y transporte</li>
      </ul>

      <h3>2.2 Temporadas y clima</h3>
      <p>Conocé cuándo es mejor visitar cada tipo de lugar.</p>

      <pre class="codigo">
Otoño (Mar-May)  : Ideal, colores y fresco agradable
Invierno (Jun-Ag): Perfecto para mate caliente al sol
Primavera (Sep-Nov): Floración, paisajes espectaculares
Verano (Dic-Feb) : Preferable lugares con sombra y agua
      </pre>
    </div>

    <!-- MÓDULO 3 -->
    <div class="card-blanco">
      <h2>Módulo 3 — La Ceremonia del Mate</h2>

      <h3>3.1 Preparación correcta</h3>
      <p>El mate tiene un ritual preciso. Aprenderlo muestra respeto por la tradición y mejora el sabor.</p>

      <h4>Pasos esenciales</h4>
      <ul>
        <li>Curar la calabaza nueva</li>
        <li>Temperatura del agua: 70–80 °C (nunca hirviendo)</li>
        <li>Posición de la yerba: inclinada en 45°</li>
        <li>La bombilla: tipos y limpieza</li>
      </ul>

      <h5>Dato cultural</h5>
      <p>Devolver el mate sin tomar es señal de rechazo; decir "gracias" indica que no querés más.</p>

      <h3>3.2 Códigos sociales</h3>
      <p>El mate en rueda tiene sus propias reglas no escritas que todo salteño conoce desde chico.</p>

      <h6>Ejercicio</h6>
      <p>Organizá una ronda de mates y documentá los códigos que observaste. Subí tu reflexión al campus.</p>
    </div>

    <!-- EVALUACIÓN Y QUIZ EN VIVO (PERSISTENCIA MYSQL) -->
    <div class="card-blanco" id="evaluacion-section">
      <h2>📋 Cuestionario Evaluativo (Persistencia en MySQL)</h2>
      <p>Demostrá tus conocimientos sobre la cultura y el ritual del mate salteño. Las respuestas se registran y califican directamente en la base de datos.</p>

      <?php if (!empty($mensaje_quiz)): ?>
        <div style="padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 0.95rem; line-height: 1.5; background: <?php echo ($tipo_alerta_quiz === 'success') ? '#e8f5e9' : (($tipo_alerta_quiz === 'danger') ? '#ffebee' : '#e3f2fd'); ?>; color: <?php echo ($tipo_alerta_quiz === 'success') ? '#2e7d32' : (($tipo_alerta_quiz === 'danger') ? '#c62828' : '#0d47a1'); ?>; border: 1px solid <?php echo ($tipo_alerta_quiz === 'success') ? '#c8ecd4' : (($tipo_alerta_quiz === 'danger') ? '#ffcdd2' : '#bbdefb'); ?>;">
          <?php echo $mensaje_quiz; ?>
        </div>
      <?php endif; ?>

      <?php if (isset($_SESSION['usuario_nombre'])): ?>
        <div style="background: #edf7f0; padding: 10px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.88rem; color: #1e7a3e;">
          👤 Rindiendo como: <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?></strong> 
          (Usuario: <code><?php echo htmlspecialchars($_SESSION['usuario_login'] ?? $_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?></code>)
        </div>
      <?php else: ?>
        <div style="background: #fff3e0; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.88rem; color: #e65100; border: 1px solid #ffe0b2;">
          💡 <strong>Tip:</strong> Para que tu nota quede vinculada a tu nombre en la base de datos, <a href="login.php" style="color: #e65100; font-weight: bold;">Inicia sesión</a> o <a href="registro.php" style="color: #e65100; font-weight: bold;">Crea tu cuenta</a> antes de enviar.
        </div>
      <?php endif; ?>

      <form method="POST" action="curso.php#evaluacion-section" style="background: #fafafa; padding: 20px; border-radius: 10px; border: 1px solid #e0e0e0;">
        
        <!-- PREGUNTA 1 -->
        <div style="margin-bottom: 20px;">
          <h4 style="color: #1e7a3e; margin-bottom: 8px;">1. ¿Cuál es la temperatura ideal del agua para cebar mate?</h4>
          <label style="display:block; margin-bottom: 6px; cursor: pointer;">
            <input type="radio" name="p1" value="a" required> 100 °C (hirviendo)
          </label>
          <label style="display:block; margin-bottom: 6px; cursor: pointer;">
            <input type="radio" name="p1" value="b" required> Entre 70 °C y 80 °C (caliente sin hervir)
          </label>
          <label style="display:block; margin-bottom: 6px; cursor: pointer;">
            <input type="radio" name="p1" value="c" required> Menos de 50 °C (tibia)
          </label>
        </div>

        <!-- PREGUNTA 2 -->
        <div style="margin-bottom: 20px;">
          <h4 style="color: #1e7a3e; margin-bottom: 8px;">2. En la ronda matera, ¿qué significa decir "gracias" al cebador?</h4>
          <label style="display:block; margin-bottom: 6px; cursor: pointer;">
            <input type="radio" name="p2" value="a" required> Que el mate está rico y quiero que me sirvan otro
          </label>
          <label style="display:block; margin-bottom: 6px; cursor: pointer;">
            <input type="radio" name="p2" value="b" required> Señal de que ya no quiero tomar más mate
          </label>
          <label style="display:block; margin-bottom: 6px; cursor: pointer;">
            <input type="radio" name="p2" value="c" required> Que el agua está fría
          </label>
        </div>

        <!-- PREGUNTA 3 -->
        <div style="margin-bottom: 24px;">
          <h4 style="color: #1e7a3e; margin-bottom: 8px;">3. ¿Cuál es el nombre científico de la planta utilizada para la yerba mate?</h4>
          <label style="display:block; margin-bottom: 6px; cursor: pointer;">
            <input type="radio" name="p3" value="a" required> Ilex paraguariensis
          </label>
          <label style="display:block; margin-bottom: 6px; cursor: pointer;">
            <input type="radio" name="p3" value="b" required> Camellia sinensis
          </label>
          <label style="display:block; margin-bottom: 6px; cursor: pointer;">
            <input type="radio" name="p3" value="c" required> Aloysia polystachya
          </label>
        </div>

        <button type="submit" name="enviar_quiz" style="background: #1e7a3e; color: #fff; padding: 12px 24px; border: none; border-radius: 8px; font-weight: bold; font-size: 1rem; cursor: pointer;">
          📤 Enviar Respuestas y Calificar
        </button>
      </form>

      <!-- HISTORIAL DE INTENTOS GUARDADOS EN MYSQL -->
      <?php if (!empty($mis_intentos)): ?>
        <div style="margin-top: 30px; border-top: 2px dashed #c8ecd4; padding-top: 20px;">
          <h3>📜 Tus calificaciones guardadas en la Base de Datos:</h3>
          <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 0.9rem;">
            <thead>
              <tr style="background: #edf7f0; color: #1e7a3e; text-align: left;">
                <th style="padding: 8px; border: 1px solid #ddd;">Intento #</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Aciertos</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Nota Final</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Estado</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Fecha</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($mis_intentos as $intento): ?>
                <tr>
                  <td style="padding: 8px; border: 1px solid #ddd;">#<?php echo htmlspecialchars($intento['id']); ?></td>
                  <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($intento['puntaje']); ?> / 3</td>
                  <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold; color: <?php echo ($intento['nota_sobre_10'] >= 6) ? '#2e7d32' : '#c62828'; ?>;">
                    <?php echo htmlspecialchars($intento['nota_sobre_10']); ?> / 10
                  </td>
                  <td style="padding: 8px; border: 1px solid #ddd;">
                    <span style="padding: 3px 8px; border-radius: 12px; font-size: 0.8rem; background: <?php echo ($intento['estado'] === 'Aprobado') ? '#e8f5e9' : '#ffebee'; ?>; color: <?php echo ($intento['estado'] === 'Aprobado') ? '#2e7d32' : '#c62828'; ?>;">
                      <?php echo htmlspecialchars($intento['estado']); ?>
                    </span>
                  </td>
                  <td style="padding: 8px; border: 1px solid #ddd; color: #666;">
                    <?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($intento['fecha']))); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>

    </div>

  </main>

<?php require_once 'includes/footer.php'; ?>
