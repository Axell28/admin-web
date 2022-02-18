<aside class="sidebar active">
    <ul class="nav_list">
        <li>
            <a href="/admin/empresa" class="<?php echo $this->nameView == 'empresa' ? 'active' : '' ?>">
                <i class="fa fa-university" aria-hidden="true"></i>
                <span class="links_name"><?php echo $this->translate('Empresa'); ?></span>
            </a>
            <span class="tooltip"><?php echo $this->translate('Empresa'); ?> </span>
        </li>
        <li>
            <a href="/admin/banner" class="<?php echo $this->nameView == 'banner' ? 'active' : '' ?>">
                <i class="fa fa-object-ungroup" aria-hidden="true"></i>
                <span class="links_name"> <?php echo $this->translate('Banner'); ?> </span>
            </a>
            <span class="tooltip"><?php echo $this->translate('Banner'); ?></span>
        </li>
        <li>
            <a href="/admin/noticias" class="<?php echo ($this->nameView == 'noticias' || $this->nameView == 'editor') ? 'active' : '' ?>">
                <i class="far fa-newspaper"></i>
                <span class="links_name"> <?php echo $this->translate('Noticias'); ?> </span>
            </a>
            <span class="tooltip"> <?php echo $this->translate('Noticias'); ?> </span>
        </li>
        <li>
            <a href="/admin/galeria" class="<?php echo $this->nameView == 'galeria' ? 'active' : '' ?>">
                <i class="far fa-images"></i>
                <span class="links_name"> <?php echo $this->translate('Galerias'); ?></span>
            </a>
            <span class="tooltip"> <?php echo $this->translate('Galerias'); ?></span>
        </li>
        <li>
            <a href="/admin/archivos" class="<?php echo $this->nameView == 'archivos' ? 'active' : '' ?>">
                <i class="far fa-folder-open"></i>
                <span class="links_name"> <?php echo $this->translate('Archivos'); ?> </span>
            </a>
            <span class="tooltip"> <?php echo $this->translate('Archivos'); ?> </span>
        </li>
        <li>
            <a href="/admin/modal" class="<?php echo $this->nameView == 'modal' ? 'active' : '' ?>">
                <i class="far fa-window-maximize"></i>
                <span class="links_name"> <?php echo $this->translate('Ventana emergente'); ?> </span>
            </a>
            <span class="tooltip"> <?php echo $this->translate('Emergente'); ?> </span>
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