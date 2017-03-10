<template>
        <ul class="pagination pagination-sm no-margin pull-right">
            <li :class="isOnFirstPage ? disabledClass : ''">
                <a @click="loadPage('prev')">«</a>
            </li>
            <template v-if="notEnoughPages">
                <template v-for="n in totalPage">
                    <li :class="isCurrentPage(n) ? 'active' : ''">
                        <a @click="loadPage(n)"> {{ n }} </a>
                    </li>
                </template>
            </template>
            <template v-else>
                <template v-for="n in windowSize">
                    <li :class="isCurrentPage(windowStart+n) ? 'active' : ''">
                        <a @click="loadPage(windowStart+n)">
                            {{ windowStart+n }}
                        </a>
                    </li>
                </template>
            </template>
            <li :class="isOnLastPage ? disabledClass : ''">
                <a @click="loadPage('next')">»</a>
            </li>
        </ul>
</template>

<script>
    import PaginationMixin from './TablePaginationMixin.vue'

    export default {
        mixins: [PaginationMixin],
        methods: {
            loadPage(page) {
                this.$emit('loadPage', page)
            }
        }
    }
</script>

<style lang="scss" scoped>
    .pagination li {
      cursor: pointer;
    }
</style>
