<template>
    <div class="container">
        <div class="form-row d-flex justify-content-center">
            <div class="col-md-12">
                <vue-web-cam
                    ref="webcam"
                    :device-id="deviceId"
                    width="100%"
                    @started="onStarted"
                    @stopped="onStopped"
                    @error="onError"
                    @cameras="onCameras"
                    @camera-change="onCameraChange"
                />
                <div class="row mt-2 d-flex justify-content-center">
                    <div class="col-md-4">
                        <label for="device">Câmera</label>
                        <select
                            v-model="camera"
                            name="device"
                            id="device"
                            class="form-control"
                        >
                            <option>Selecione o Dispositivo</option>
                            <option
                                v-for="device in devices"
                                :key="device.deviceId"
                                :value="device.deviceId"
                                >{{ device.label }}</option
                            >
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { WebCam } from "vue-web-cam";
export default {
    name: "App",
    components: {
        "vue-web-cam": WebCam
    },
    data() {
        return {
            img: null,
            camera: null,
            deviceId: null,
            devices: []
        };
    },
    computed: {
        device: function() {
            return this.devices.find(n => n.deviceId === this.deviceId);
        }
    },
    watch: {
        camera: function(id) {
            this.deviceId = id;
        },
        devices: function() {
            const [first, ...tail] = this.devices;
            if (first) {
                this.camera = first.deviceId;
                this.deviceId = first.deviceId;
            }
        }
    },
    methods: {
        onCapture() {
            this.img = this.$refs.webcam.capture();
            window.events.$emit("get_avatar", this.$refs.webcam.capture());
        },
        onStarted(stream) {},
        onStopped(stream) {},
        onStop() {
            this.$refs.webcam.stop();
        },
        onStart() {
            this.$refs.webcam.start();
        },
        onError(error) {},
        onCameras(cameras) {
            this.devices = cameras;
        },
        onCameraChange(deviceId) {
            this.deviceId = deviceId;
            this.camera = deviceId;
        }
    },
    created() {
        window.events.$on("capture", () => {
            this.onCapture();
        });

        window.events.$on("stop", () => {
            this.onStop();
        });

        window.events.$on("start", () => {
            this.onStart();
        });
    }
};
</script>
