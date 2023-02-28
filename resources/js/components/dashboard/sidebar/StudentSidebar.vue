<template>
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item"  @click.stop="$root.changeRoute('/dashboard')">
            <a class="nav-link collapsed hand">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
            <a
                class="nav-link  hand"
                @click.stop="$root.changeRoute('/teacher')"
            >
                <i class="bi bi-person"></i>
                <span>Teacher</span>
            </a>
        </li>
        <li class="nav-item">
            <a
                class="nav-link collapsed hand"
                @click.stop="$root.changeRoute('/payment')"
            >
                <i class="bi bi-send"></i>
                <span>Payment</span>
            </a>
        </li>
        <!-- End Student Nav -->
    </ul>
</template>
