<hr class="footer-line" />
  <footer class="site-footer">
    <p>2025 Salta de Mates - Enriquez Tiago - 4 3 TM CS</p>
    <nav aria-label="Navegacion del pie de pagina">
      <a href="faq.php">Preguntas Frecuentes</a> |
      <a href="quienes-somos.php">Quienes Somos</a> |
      <a href="blog.php">Blog</a>
    </nav>
  </footer>

  <script>
    function actualizarReloj() {
      var ahora = new Date();
      var fecha = ahora.toLocaleDateString('es-AR', { weekday:'long', year:'numeric', month:'long', day:'numeric' });
      var hora = ahora.toLocaleTimeString('es-AR');
      var relojBar = document.getElementById('reloj-bar');
      if (relojBar) {
        relojBar.textContent = 'Fecha: ' + fecha + '  |  Hora: ' + hora;
      }
    }
    actualizarReloj();
    setInterval(actualizarReloj, 1000);
  </script>
</body>
</html>