<template>
    <section class="mainSearch">
        <div>
            <!-- <h1>Questa è la sezione della search del main</h1> -->
            <input type="text">
        </div>
        
        <section class="container">
            <div>
                <h3 class="content">Element</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Element</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Element</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Element</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Element</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Element</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Element</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Element</h3>
            </div>
        </section>
        <section class="container">
            <div>
                <h3 class="content">Element</h3>
            </div>
        </section>
    </section>

</template>

<script>
export default {
    name: "MainSearch"
}
</script>

<style lang="scss" scoped>
    .mainSearch {
        display: flex;
        flex-wrap: wrap;
        background-color: lightgoldenrodyellow;
        padding: 15px;
        div {
            width: 100%;
            h1 {
            width: 100%;
            }
            input {
                margin-bottom: 10px;
            }
        }
        
        .container {
            display: flex;
            flex-wrap: wrap;
            width: calc(100%/6);
            min-height: 30px;
            margin: 5px 0;
            
            background-image: url(https://www.ecosia.org/images?q=background%20post%20it&imageType=transparent#f=true&id=3700C82B7A673D5D69AE2D06F28786001FAFAD4D);

            div {
                display: flex;
                flex-wrap: wrap;
                position: relative;
                width: 100%;
                border: 2px solid grey;
                border-radius: 10px;
            }

            .content {
                margin: auto;
                font-size: 12px;
            }
        }
    }
    

</style>