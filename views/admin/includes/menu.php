<aside class="sidebar active">
    <ul class="nav_list">
        <li>
            <a href="/admin/home" class="<?php echo $this->nameView == 'home' ? 'active' : '' ?>">
                <i class="fa fa-university" aria-hidden="true"></i>
                <span class="links_name">Inicio</span>
            </a>
            <span class="tooltip">Inicio</span>
        </li>
        <li>
            <a href="/admin/banner" class="">
                <i class="fa fa-object-ungroup" aria-hidden="true"></i>
                <span class="links_name">Banner</span>
            </a>
            <span class="tooltip">Banner</span>
        </li>
        <li>
            <a href="/admin/noticias" class="<?php echo $this->nameView == 'noticias' ? 'active' : '' ?>">
                <i class="far fa-newspaper"></i>
                <span class="links_name">Noticias</span>
            </a>
            <span class="tooltip">Noticias</span>
        </li>
        <li>
            <a href="/admin/revista" class="">
                <i class="fas fa-list-ul"></i>
                <span class="links_name">Revista</span>
            </a>
            <span class="tooltip">Revista</span>
        </li>
        <li>
            <a href="/admin/galeria" class="<?php echo $this->nameView == 'galeria' ? 'active' : '' ?>">
                <i class="far fa-images"></i>
                <span class="links_name">Galerias</span>
            </a>
            <span class="tooltip">Galerías</span>
        </li>
        <li>
            <a href="/admin/archivos" class="">
                <i class="far fa-folder-open"></i>
                <span class="links_name">Archivos</span>
            </a>
            <span class="tooltip">Archivos</span>
        </li>
        <li>
            <a href="/admin/modal" class="">
                <i class="far fa-window-maximize"></i>
                <span class="links_name">Ventana emergente</span>
            </a>
            <span class="tooltip">Emergente</span>
        </li>
    </ul>
</aside>


<script>
    let btn = document.querySelector("#btnMenu");
    let sidebar = document.querySelector(".sidebar");
    btn.onclick = function() {
        sidebar.classList.toggle("active");
    };
</script>