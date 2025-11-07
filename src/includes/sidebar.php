<!-- Sidebar Navigation -->  
<!-- Botón para abrir el menú -->  
<button class="menu-toggle" id="menuToggle">  
  <i class="bi bi-list"></i> Menú  
</button>  
  
<!-- Overlay oscuro -->  
<div class="sidebar-overlay" id="sidebarOverlay"></div>  
  
<!-- Sidebar -->  
<nav class="sidebar" id="sidebar">  
  <div class="sidebar-header">  
    <h3><i class="bi bi-building"></i> Sistema de Asistencia</h3>  
  </div>  
    
  <ul class="sidebar-menu">  
    <li>  
      <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">  
        <i class="bi bi-house-door"></i>  
        <span>Inicio</span>  
      </a>  
    </li>  
      
    <li>  
      <a href="empleado.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'empleado.php' ? 'active' : ''; ?>">  
        <i class="bi bi-people"></i>  
        <span>Empleados</span>  
      </a>  
    </li>  
      
    <li>  
      <a href="asistencia.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'asistencia.php' ? 'active' : ''; ?>">  
        <i class="bi bi-calendar-check"></i>  
        <span>Asistencias</span>  
      </a>  
    </li>  
      
    <li>  
      <a href="rol.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'rol.php' ? 'active' : ''; ?>">  
        <i class="bi bi-person-badge"></i>  
        <span>Roles</span>  
      </a>  
    </li>  
      
    <li>  
      <a href="horario.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'horario.php' ? 'active' : ''; ?>">  
        <i class="bi bi-clock"></i>  
        <span>Horarios</span>  
      </a>  
    </li>  
      
    <li>  
      <a href="dia_no_laboral.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dias_no_laborales.php' ? 'active' : ''; ?>">  
        <i class="bi bi-calendar-x"></i>  
        <span>Días No Laborales</span>  
      </a>  
    </li>  
  </ul>  
</nav>  
  
<script>  
  // Toggle sidebar  
  const menuToggle = document.getElementById('menuToggle');  
  const sidebar = document.getElementById('sidebar');  
  const overlay = document.getElementById('sidebarOverlay');  
    
  menuToggle.addEventListener('click', function() {  
    sidebar.classList.toggle('active');  
    overlay.classList.toggle('active');  
  });  
    
  overlay.addEventListener('click', function() {  
    sidebar.classList.remove('active');  
    overlay.classList.remove('active');  
  });  
    
  // Cerrar sidebar al hacer clic en un enlace (en móviles)  
  const sidebarLinks = document.querySelectorAll('.sidebar-menu a');  
  sidebarLinks.forEach(link => {  
    link.addEventListener('click', function() {  
      if (window.innerWidth <= 768) {  
        sidebar.classList.remove('active');  
        overlay.classList.remove('active');  
      }  
    });  
  });  
</script>