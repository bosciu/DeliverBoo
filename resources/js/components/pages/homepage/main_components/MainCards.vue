<template>
    <section class="mainCards">
        <!-- <h1>Questa è la sezione delle cards del main</h1> -->
        <section class="container">
            <div>
                <h3 class="content">Card ristorante</h3>
            </div>
        </section>
        
        <section class="container">
            <div>
                <h3 class="content">Card ristorante</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Card ristorante</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Card ristorante</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Card ristorante</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Card ristorante</h3>
            </div>
        </section>
    </section>
</template>

<script>
export default {
    name: "MainCards"
}
</script>

<style lang="scss" scoped>
    .mainCards {
        display: flex;
        flex-wrap: wrap;
        background-color: lightsteelblue;
        padding: 10px;
        border-top: 2px solid black;
        border-bottom: 2px solid black;
        h1 {
            width: 100%;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            width: calc(100%/6);
            min-height: 200px;
            margin: 5px 0;
            
            background-image: url(https://www.ecosia.org/images?q=background%20post%20it&imageType=transparent#f=true&id=3700C82B7A673D5D69AE2D06F28786001FAFAD4D);

            div {
                display: flex;
                flex-wrap: wrap;
                position: relative;
                width: 100%;
                background-color: #F8F587;
                border: 2px solid black;
                border-radius: 10px;
            }

            .content {
                margin: auto;
            }
        }
    }



</style>