<template>
    <Header />
    <Head>
        <title>My App</title>
        <meta
            type="description"
            content="description about my app"
            head-key="description"
        />
    </Head>
    <section class="bg-gray-200">
        <header class="flex justify-between">
            <h1 class="font-bold text-lg">my Site</h1>
            <!-- <p>weclome {{ username }}</p> -->
            <h1>Welcome, {{ user }}</h1>

            <Nav />
        </header>
    </section>
    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <slot />
        </div>
    </section>
    <Footer />
</template>
<script setup>
import Nav from "./Nav.vue";
import { computed, watch, watchEffect } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import Header from "../Components/Header.vue";
import Footer from "../Components/Footer.vue";

// const props = defineProps(["auth"]);

const page = usePage();

console.log("page.props.user: ", page.props.auth.user);
console.log("page.props.user: ", page.props);

const user = computed(() => page.props.auth.user.username);

// watchEffect(() => {
//     console.log("usePage(): ", usePage().props.value);
// });

// const { auth } = usePage().props;
// const user = auth.user;

// console.log("usepage", usePage());
// watch(username, (username_w) => {
//     console.log("username_w: ", username_w);
// });
</script>
