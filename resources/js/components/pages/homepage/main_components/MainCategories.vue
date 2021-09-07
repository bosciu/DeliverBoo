<template>
    <section class="mainCategories">
        <!-- <h1>Questa è la sezione delle categories del main</h1> -->
        <section class="container container-1">
            <div>
                <h3 class="content">CATEGORIA</h3>
            </div>
            <a href=""><small>Scopri il "nomecategoria"</small></a>
        </section>
        
        <section class="container container-2">
            <div>
                <h3 class="content">CATEGORIA</h3>
            </div>
            <a href=""><small>Scopri il "nomecategoria"</small></a>
        </section>
        <section class="container container-2">
            <div>
                <h3 class="content">CATEGORIA</h3>
            </div>
            <a href=""><small>Scopri il "nomecategoria"</small></a>
        </section>
        <section class="container container-1">
            <div>
                <h3 class="content">CATEGORIA</h3>
            </div>
            <a href=""><small>Scopri il "nomecategoria"</small></a>
        </section>
    </section>
</template>

<script>
export default {
    name: "MainCategories"
}
</script>

<style lang="scss" scoped>
    .mainCategories {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        background-color: lightgoldenrodyellow;
        padding: 10px;

        h1 {
            width: 100%;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            min-height: 100px;

            div {
                display: flex;
                flex-wrap: wrap;
                width: 100%;
                border: 2px solid black;
            }

            .content {
                margin: auto;
            }
        }
        .container-1 {
            width: 35%;
        }
        .container-2 {
            width: 60%;
        }
    }
</style>