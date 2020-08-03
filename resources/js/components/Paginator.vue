<template>
    <nav>
        <ul class="pagination justify-content-center">
            <li
                class="page-item"
                :class="{ disabled: paginate.first_page_url == null }"
            >
                <a
                    class="page-link"
                    :href="paginate.first_page_url"
                    tabindex="-1"
                    :aria-disabled="
                        paginate.first_page_url != null ? 'false' : 'true'
                    "
                    @click.prevent="page(paginate.first_page_url)"
                    >Primeira</a
                >
            </li>
            <li
                class="page-item"
                :class="{ disabled: paginate.prev_page_url == null }"
            >
                <a
                    class="page-link"
                    :href="paginate.prev_page_url"
                    aria-label="Previous"
                    :aria-disabled="
                        paginate.prev_page_url != null ? 'false' : 'true'
                    "
                    @click.prevent="page(paginate.prev_page_url)"
                >
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item active" aria-current="page">
                <a
                    class="page-link"
                    href="#"
                    v-html="
                        `${
                            paginate.current_page
                        } <span class='sr-only'>(current)</span> de ${paginate.last_page}`
                    "
                ></a>
            </li>
            <li
                class="page-item"
                :class="{ disabled: paginate.next_page_url == null }"
            >
                <a
                    class="page-link"
                    :href="paginate.next_page_url"
                    aria-label="Next"
                    :aria-disabled="
                        paginate.next_page_url != null ? 'false' : 'true'
                    "
                    @click.prevent="page(paginate.next_page_url)"
                >
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <li
                class="page-item"
                :class="{ disabled: paginate.last_page_url == null }"
            >
                <a
                    class="page-link"
                    :href="paginate.last_page_url"
                    tabindex="-1"
                    :aria-disabled="
                        paginate.last_page_url != null ? 'false' : 'true'
                    "
                    @click.prevent="page(paginate.last_page_url)"
                    >Última</a
                >
            </li>
        </ul>
    </nav>
</template>
<script>
export default {
    props: ["paginate"],
    methods: {
        page(url) {
            this.$emit("page", url);
        }
    }
};
</script>
