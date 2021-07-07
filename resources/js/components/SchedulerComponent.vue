<template>
    <div>
        <div class="gstc-wrapper" ref="gstc"></div>
    </div>
</template>

<script>
import GSTC from "gantt-schedule-timeline-calendar";
import axios from "axios";

import { Plugin as TimelinePointer } from "gantt-schedule-timeline-calendar/dist/plugins/timeline-pointer.esm.min.js";
import { Plugin as Selection } from "gantt-schedule-timeline-calendar/dist/plugins/selection.esm.min.js";
import { Plugin as ItemMovement } from "gantt-schedule-timeline-calendar/dist/plugins/item-movement.esm.min.js";
//import { Plugin as ItemResizing } from 'gantt-schedule-timeline-calendar/dist/plugins/item-resizing.esm.min.js';
import { Plugin as CalendarScroll } from "gantt-schedule-timeline-calendar/dist/plugins/calendar-scroll.esm.min.js";
import { Plugin as HighlightWeekends } from "gantt-schedule-timeline-calendar/dist/plugins/highlight-weekends.esm.min.js";
import { Plugin as DependencyLines } from "gantt-schedule-timeline-calendar/dist/plugins/dependency-lines.esm.min.js";
import { Plugin as ItemTypes } from "gantt-schedule-timeline-calendar/dist/plugins/item-types.esm.min.js";
import "gantt-schedule-timeline-calendar/dist/style.css";

let gstc, state;

const colors = [
    "#E74C3C",
    "#DA3C78",
    "#7E349D",
    "#0077C0",
    "#07ABA0",
    "#0EAC51",
    "#F1892D"
];
function getRandomColor() {
    return colors[Math.floor(Math.random() * colors.length)];
}

// main component

export default {
    name: "GSTC",
    props: ["deliverable"],
    data() {
        return {
            deliverables: this.deliverable,
            rows: {},
            items: {},
            movementPluginConfig: {
                events: {
                    onMove({ items }) {
                        // prevent items to change row
                        return items.before.map((beforeMovementItem, index) => {
                            const afterMovementItem = items.after[index];
                            const myItem = GSTC.api.merge(
                                {},
                                afterMovementItem
                            );
                            // if (!canChangeRow) {
                            myItem.rowId = beforeMovementItem.rowId;
                            //}
                            // if (!canCollide && isCollision(myItem)) {
                            // myItem.time = { ...beforeMovementItem.time };
                            // myItem.rowId = beforeMovementItem.rowId;
                            // }

                            return myItem;
                        });
                    },
                    onEnd({ items }) {
                        // prevent items to change row
                        return items.before.map((beforeMovementItem, index) => {
                            const afterMovementItem = items.after[index];
                            const myItem = GSTC.api.merge(
                                {},
                                afterMovementItem
                            );
                            // if (!canChangeRow) {
                            //myItem.rowId = beforeMovementItem.rowId;
                            //}
                            // if (!canCollide && isCollision(myItem)) {
                            // myItem.time = { ...beforeMovementItem.time };
                            // myItem.rowId = beforeMovementItem.rowId;
                            // }

                            try {
                                const response = axios.post(
                                    "/ptrack/public/api/sales/projects/deliverables/update/" +
                                        afterMovementItem.id,
                                    {
                                        data:
                                            gstc.state.data.config.chart.items[
                                                afterMovementItem.id
                                            ]
                                    }
                                );
                                // this.holidays = response.data.data.count;
                                // return response.data.data.count;
                            } catch (e) {
                                console.log(e);
                                // handle the authentication error here
                            }

                            return myItem;
                        });
                    }
                }

                // snapToTime: {
                // start({ startTime, time }) {
                // return startTime.startOf('day').add(12, 'hour');
                // },
                // },
            }
        };
    },
    mounted() {
        /**
         * @type { import("gantt-schedule-timeline-calendar").Config }
         */

        this.generateRows();
        this.generateItems();
        const config = {
            licenseKey:
                "====BEGIN LICENSE KEY====\\nH2GvVNSnl8p0I0H07IswY2D8GgTRROeSgMtrEWfMbal+M5rh7lYvIupom4v03kXu3gR79dGD3ppcjzQG7cwyGFNi0TOwzXBrg02qwd3NlBlYezdkQJ9kgVDTGxL+95pFDoFLRy4vLbsdI5JIwtstJBnMyC2BC/MmCBvm5IgjDH8nJDWX+lgs+ErQqJSGvbw8q7AcSV8dC/3SbJF4C3oNJwuXZ48McifLX9vJBj4vql+WLSSVTA0pLik7eRRXYIekx1GVxHpj29Cjim1vlEjN1RURiWCgoMMS2t3Uqkx9ds60wGPccOfHgWDXiI0oBtwZVL8Iwx9kuNlOksgV3e854A==||U2FsdGVkX1/wApJXBNeSaDA8JZIBx64x0bTvdHrryn3yaQvSwuo3NlOVkPwU4OUZuQ2BzBYVHqJ7cNwFY1JfgsKU+HHBTxQKVSLF6M9ydPI=\\ncaHLooyEoG0rmS16CE6Y7IWw7XZo4ddnXi3HYMqF8rvATP5wvkua3EQkNjgA8uGK2ThpB5e2VpQ+7LXpJHEuL/SECO5ej/4cBjoCzk8DisT74wdkBOdT6oKg5GmmC97qWcvmCaEN+ZXeJivbv0mi5NWTQQYtdLnjWy5exFPRvIV3gW/No8g4YWINFDNUj5ohEf9KOrXpgamqAJrExNu5MUTeBbT6E3HuW6nltaxKk+O93aBT5Y/sn4qmss1ejzi2Yjcz5K1rhnspXrUqt8IvBVfpLlLEjxPKTnkP6cmK8nlAL3KFxUmY0iP+NO1APrM7dcbY8ZMQoyxwgeE8dd345w==\\n====END LICENSE KEY====",
            plugins: [
                HighlightWeekends(),
                TimelinePointer(),
                Selection(),
                //ItemResizing(),
                ItemMovement(this.movementPluginConfig),
                CalendarScroll(),
                DependencyLines(),
                ItemTypes()
            ],
            list: {
                columns: {
                    data: {
                        [GSTC.api.GSTCID("id")]: {
                            id: GSTC.api.GSTCID("id"),
                            width: 60,
                            data: ({ row }) => GSTC.api.sourceID(row.id),
                            header: {
                                content: "ID"
                            }
                        },
                        [GSTC.api.GSTCID("label")]: {
                            id: GSTC.api.GSTCID("label"),
                            width: 200,
                            data: "label",
                            header: {
                                content: "Deliverables"
                            }
                        }
                    }
                },
                rows: this.rows
            },
            chart: {
                items: this.items
            }
        };

        state = GSTC.api.stateFromConfig(config);

        gstc = GSTC({
            element: this.$refs.gstc,
            state
        });
    },

    beforeUnmount() {
        gstc.Items;
        if (gstc) gstc.destroy();
    },

    methods: {
        updateFirstRow() {
            state.update(`config.list.rows.${GSTC.api.GSTCID("0")}`, row => {
                row.label = "Changed dynamically";
                return row;
            });
        },

        changeZoomLevel() {
            state.update("config.chart.time.zoom", 21);
        },

        generateRows() {
            this.rows = {};
            for (let key of Object.keys(this.deliverables)) {
                const id = key;
                this.rows[id] = {
                    id,
                    label: key
                };
            }

        },

        /**
         * @returns { import("gantt-schedule-timeline-calendar").Items }
         */
        generateItems() {
            this.items = {};

            let start = GSTC.api
                .date()
                .startOf("day")
                .subtract(6, "day");
            for (let key of Object.keys(this.deliverables)) {

                for (let j = 0; j < this.deliverables[key].length; j++) {


                    const id = GSTC.api.GSTCID(
                        this.deliverables[key][j].id
                    );


                    start = start.add(1, "day");
                    this.items[id] = {
                        id,
                        label: this.deliverables[key][j].task,
                        type: "task",
                        fill: getRandomColor(),
                        rowId: key,
                        time: {
                            start: GSTC.api
                                .date(
                                    this.deliverables[key][j].start_date
                                )
                                .startOf("day")
                                .valueOf(),
                            end: GSTC.api
                                .date(
                                    this.deliverables[key][j].end_date
                                )
                                .startOf("day")
                                .valueOf()
                        }
                    };
                    if (this.deliverable[key][j].predecessor !== "NA") {

                     this.items[GSTC.api.GSTCID(this.deliverables[key][j].id)].dependant = [GSTC.api.GSTCID(this.deliverable[key].filter(x => x.task == this.deliverables[key][j].predecessor)[0].id)];
                     this.items[GSTC.api.GSTCID(this.deliverables[key][j].id)].linkedWith = [GSTC.api.GSTCID(this.deliverable[key].filter(x => x.task == this.deliverables[key][j].predecessor)[0].id)];
                }
                }


            }
        },


    }
};
</script>
<style scoped>
.gstc-component {
    margin: 0;
    padding: 0;
}
.toolbox {
    padding: 10px;
}
</style>
