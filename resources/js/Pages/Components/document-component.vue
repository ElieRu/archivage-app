<script>
import { Link, router, useForm } from "@inertiajs/vue3";
import axios from "axios";

export default {
    props: ["documents", "render_page"],
    emits: ["get-document", "get-document-id"],
    components: {
        Link,
    },
    data() {
        return {
            datas: useForm({
                id: null,
                render_page: null,
            }),
        };
    },
    computed: {
        get_documents() {
            return this.documents;
        },
    },
    mounted() {},
    methods: {
        deleteDocument(id) {
            this.datas.id = id;
            this.datas.render_page = this.render_page;
            this.datas.delete("/documents");
        },
    },
};
</script>

<template>
    <div
        v-for="(document, index) in get_documents.data"
        :key="index"
        class="col-sm-4 col-lg-3 col-xl-2"
    >
        <div class="border rounded p-2" style="overflow: visible">
            <div
                class="d-flex justify-content-center"
                style="position: relative"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="-64 0 512 512"
                    width="1em"
                    height="1em"
                    fill="currentColor"
                    style="
                        font-size: 100px;
                        padding-top: 20px;
                        padding-bottom: 7px;
                    "
                >
                    <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"
                    ></path>
                </svg>
                <div
                    class="dropdown"
                    style="position: absolute; top: 0px; right: 0px"
                >
                    <button111111
                        class="btn btn-primary bg-transparent border-0"
                        aria-expanded="false"
                        data-bs-toggle="dropdown"
                        type="button"
                    >
                        <svg
                            class="text-body-secondary"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="-192 0 512 512"
                            width="1em"
                            height="1em"
                            fill="currentColor"
                        >
                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"
                            ></path>
                        </svg>
                    </button111111>
                    <div class="dropdown-menu">
                        <a
                            class="dropdown-item"
                            style="cursor: pointer"
                            data-bs-target="#update-modal"
                            data-bs-toggle="modal"
                            @click="$emit('get-document', document)"
                            >Modifier</a
                        ><a
                            class="dropdown-item"
                            style="cursor: pointer"
                            data-bs-target="#share-modal"
                            data-bs-toggle="modal"
                            @click="$emit('get-document-id', document.id)"
                            >Partager</a
                        ><a
                            class="dropdown-item"
                            style="cursor: pointer"
                            @click="download(document.id)"
                            >Télécharger</a
                        ><a
                            class="dropdown-item"
                            style="cursor: pointer"
                            @click="deleteDocument(document.id)"
                            >Supprimer</a
                        ><a
                            class="dropdown-item"
                            style="cursor: pointer"
                            data-bs-target="#properties-modal"
                            data-bs-toggle="modal"
                            @click="$emit('get-document', document)"
                            >Proprietés</a
                        >
                    </div>
                </div>
            </div>
            <span style="font-size: 13px">{{
                document.titre.length < 15
                    ? document.titre
                    : document.titre.slice(0, 15) + "..."
            }}</span>
        </div>
    </div>
</template>
