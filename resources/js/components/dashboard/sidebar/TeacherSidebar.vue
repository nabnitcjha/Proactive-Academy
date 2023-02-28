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
                @click.stop="$root.changeRoute('/student')"
            >
                <i class="bi bi-person"></i>
                <span>Student</span>
            </a>
        </li>
        <li class="nav-item">
            <a
                class="nav-link collapsed hand"
                @click.stop="$root.changeRoute('/teacher-classes')"
            >
                <i class="bi bi-person"></i>
                <span>Class</span>
            </a>
        </li>
        <!-- End Student Nav -->
    </ul>
</template>
