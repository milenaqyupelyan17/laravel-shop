<div class="row">
    <div class="col">
        <div class="wrapper">
            <i class="fa-solid fa-table-cells-large"></i>
            <div class="w-700">All Categories</div>
            <div class="title-6 W-700">BRAND</div>
            <input type="search" placeholder="Search">
            <div class="title-6 W-700">MODEL</div>
            <div class="title-6 text-grey">Short 60</div>
            <div class="title-6 text-grey">Mid-length 10</div>
            <div class="title-6 text-grey">Sweather 56</div>
            <div class="title-6 text-grey">Party Dresses 80</div>
            <div class="title-6 text-grey">Regular Fit 100</div>
            <div class="title-6 W-700">STYLE</div>
            <div class="title-6"><input type="checkbox"> Casual</div>
            <div class="title-6"><input type="checkbox"> Business casual</div>
            <div class="title-6">
                <input type="checkbox"> Bohemian
            </div>
            <div class="title-6">
                <input type="checkbox"> Minimalist
            </div>
            <div class="title-6">
                <input type="checkbox"> Uniqlo
            </div>
            <div class="title-6">
                <input type="checkbox"> Zara
            </div>
            <div class="title-6">
                <input type="checkbox"> Gucci
            </div>
            <div class="title-6">
                <input type="checkbox"> Mango
            </div>
            <div class="title-6">
                <input type="checkbox"> Ralph Lauren
            </div>
            <div class="title-6">
                <input type="checkbox"> Calvin Klein
            </div>
            <div class="title-6 W-700">COLOR</div>
            <div class="title-10 font-2 p-top">Colors</div>
            <div class="flex colors gap-5">
                <label>
                    <input type="radio" name="color" value="red">
                    <div class="color" style="background-color: #FF2E00;"></div>
                </label>
                <label>
                    <input type="radio" name="color" value="beige">
                    <div class="color" style="background-color: #F7DDD0;"></div>
                </label>
                <label>
                    <input type="radio" name="color" value="blue">
                    <div class="color" style="background-color: #66A5FF;"></div>
                </label>
                <label>
                    <input type="radio" name="color" value="orange">
                    <div class="color" style="background-color: #FF9D41;"></div>
                </label>
                <label>
                    <input type="radio" name="color" value="yellow">
                    <div class="color" style="background-color: #FFD36C;"></div>
                </label>
                <label>
                    <input type="radio" name="color" value="green">
                    <div class="color" style="background-color: #4BCB88;"></div>
                </label>
            </div>
            <div class="flex colors gap-5">
                <label>
                    <input type="radio" name="color" value="purple">
                    <div class="color" style="background-color: #9747FF;"></div>
                </label>
                <label>
                    <input type="radio" name="color" value="pink">
                    <div class="color" style="background-color: #FF67DE;"></div>
                </label>
                <label>
                    <input type="radio" name="color" value="brown">
                    <div class="color" style="background-color: #967C62;"></div>
                </label>
                <label>
                    <input type="radio" name="color" value="black">
                    <div class="color" style="background-color: #434343;"></div>
                </label>
                <label>
                    <input type="radio" name="color" value="grey">
                    <div class="color" style="background-color: #BCBFC2;"></div>
                </label>
                <label>
                    <input type="radio" name="color" value="light">
                    <div class="color" style="background-color: #d0cbd6;"></div>
                </label>
            </div>
        </div>
        <div class="flex flex-column gap-5">
            <div class="title-10 font-2">Size</div>
            <div class="sizes flex gap-10">
                <input type="radio" name="size" id="size-2xs">
                <label for="size-2xs">2XS</label>
                <input type="radio" name="size" id="size-xs">
                <label for="size-xs">XS</label>
                <input type="radio" name="size" id="size-s">
                <label for="size-s">S</label>
                <input type="radio" name="size" id="size-m" checked>
                <label for="size-m">M</label>
            </div>
        </div>
        <div class="title-6 text-grey">
            ///
        </div>
    </div>
    <div class="col">
        <div class="wrapper">
            @include('product-list', ['products' => $products])
        </div>
    </div>
</div>