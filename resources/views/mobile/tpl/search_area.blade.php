<div id="mobSearchArea" class="loadin">
    <div class="modal-bg" onclick="stopSearching()"></div>
    <div id="content">
        <div id="mobSearchBar" class="an-action-bar layout center justified">
            <button id="backBtn" class="layout center action-button" onclick="stopSearching()">
                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
            </button>

            <input placeholder="Search for products" required type="search" name="search_query" id="mobSearchInput" class="flex"
                   onkeyup="loadResults(this.value)"
                   onchange="loadResults(this.value)">

            <button id="searchClearer" class="layout center action-button" onclick="clearSearchInput()">
                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    <path d="M0 0h24v24H0z" fill="none"/>
                </svg>
            </button>
        </div>

        <div id="mobSearchResults">
            <div id="loader" class="layout vertical center-center">
                Fetching products...
            </div>

            Here are the results...
        </div>
    </div>
</div>