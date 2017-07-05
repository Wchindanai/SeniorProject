
import React from 'react';
import ReactDOM from 'react-dom';
import {Bar} from 'react-chartjs-2';

// var Chart = require('react-d3-core').Chart;
// var LineChart = require('react-d3-basic').LineChart;
var DatePicker = require('react-datepicker');
var moment = require('moment');

require('react-datepicker/dist/react-datepicker.css');

class SelectTime extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            value: 'Day',
            date: moment()
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeDate = this.handleChangeDate.bind(this);
    }
    handleChange(event) {
        this.setState({value: event.target.value});
    }
    handleChangeDate(date){
        this.setState({date:date})
    }
    handleSubmit(event) {
        var value = this.state.value;
        if(value == 'Day'){
            var unixTime = new Date(this.state.date);
            var date ='';
            date += unixTime.getFullYear()+"/";
            date +=  unixTime.getMonth()+1+"/";
            date += unixTime.getDate();
            this.showChart(value, date);
        }
        if(value == 'Month'){
            // var year = new Date();
            var year = $("#selectMonthYear").val();
            var date = year+"-";
            console.log(date);
            date += $("#selectMonth").val();
            this.showChart(value, date);
        }
        if(value == 'Year'){
            var year = $("#selectYear").val();
            this.showChart(value, year);
        }
        event.preventDefault();
    }

    showChart(type, dataLog) {
        $.ajax({
            url:'getDataChart',
            method:'POST',
            data: {type: type, data: dataLog},
            success:function (data) {
                console.log(data);
                if(type == 'Day'){
                    var dataChart = data.split(" ");
                    // console.log(dataChart);
                     const chartData = {
                        labels: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
                        datasets: [
                            {
                                label: dataLog,
                                backgroundColor: 'rgba(255,99,132,0.2)',
                                borderColor: 'rgba(255,99,132,1)',
                                borderWidth: 1,
                                hoverBackgroundColor: 'rgba(255,99,132,0.4)',
                                hoverBorderColor: 'rgba(255,99,132,1)',
                                data: dataChart
                            }
                        ],
                            options:[{
                                responsive: true,
                                scales: {
                                    yAxes: [{
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Count'
                                        }
                                    }],
                                    xAxes:[{
                                        scaleLabel:{
                                            display: true,
                                            labelString: 'Times'
                                        }
                                    }]
                                }
                            }]
                    };
                    ReactDOM.render(<Bar data={chartData}/>,document.getElementById('graph'));
                }
                else if(type == 'Month'){
                    var dataChart = data.split(" ");
                    var day = [];
                    for(var i = 1; i <= 31 ; i++){
                        day.push(i);
                    }
                    const chartData = {
                        labels: day,
                        datasets: [
                            {
                                label: dataLog,
                                backgroundColor: 'rgba(255,99,132,0.2)',
                                borderColor: 'rgba(255,99,132,1)',
                                borderWidth: 1,
                                hoverBackgroundColor: 'rgba(255,99,132,0.4)',
                                hoverBorderColor: 'rgba(255,99,132,1)',
                                data: dataChart
                            }
                        ],
                        options:[{
                            responsive: true
                        }]
                    };
                    ReactDOM.render(<Bar data={chartData}/>,document.getElementById('graph'));
                }
                else if(type == 'Year'){
                    var dataChart = data.split(" ");
                    // console.log(dataChart);
                    const chartData = {
                        labels: ["January","February","March","April","May","June","July","August","September","October","November","December"],
                        datasets: [
                            {
                                label: dataLog,
                                backgroundColor: 'rgba(255,99,132,0.2)',
                                borderColor: 'rgba(255,99,132,1)',
                                borderWidth: 1,
                                hoverBackgroundColor: 'rgba(255,99,132,0.4)',
                                hoverBorderColor: 'rgba(255,99,132,1)',
                                data: dataChart
                            }
                        ],
                        options:[{
                            responsive: true
                        }]
                    };
                    ReactDOM.render(<Bar data={chartData}/>,document.getElementById('graph'));
                }

            }

        });



    }



    render() {
        var selectType;
        var btn;
        // var btn = <Btn this.state.type="Month"/>;

        var inputDate;
        if (this.state.value == 'Year') {
            selectType = <SelectYear/>;
            btn = <button className="btn btn-info" value={this.state.value} type="submit" id="btncal">
                <i className="glyph-icon icon-calendar"></i>
            </button>;
        }
        if (this.state.value == 'Month') {
            selectType = <SelectMonth/>;
            btn = <button className="btn btn-info" value={this.state.value} type="submit" id="btncal">
                <i className="glyph-icon icon-calendar"></i>
            </button>;

        }
        if (this.state.value == 'Day') {
            btn = <button className="btn btn-info" value={this.state.value} type="submit" id="btncal">
                <i className="glyph-icon icon-calendar"></i>
            </button>;
            inputDate = <DatePicker
                selected={this.state.date}
                onChange={this.handleChangeDate} className="form-control" id="selectDate"/>
        }
        return <div>
            <form onSubmit={this.handleSubmit}>
            <select className="form-control" id="TimeType" style={{width: 100, float: 'left'}} value={this.state.value} onChange={this.handleChange}>
                <option value="Day">Day</option>
                <option value="Month">Month</option>
                <option value="Year">Year</option>
            </select>
            {selectType}{inputDate}{btn}
                </form>
        </div>

    }
}

class SelectDate extends React.Component{
    render(){
        return <input className="form-control datepicker" id="selectDate" style={{width:150, float:'left'}} />
    }
}

class SelectMonth extends React.Component{
    render(){
        return <div>
            <select className="form-control" id="selectMonth"  style={{width:100,float:'left'}}>
                <option value="01">January</option>
                <option value="02">Febuary</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <select className="form-control" id="selectMonthYear" style={{width:100,float:'left'}}>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
            </select>
        </div>

    }
}

class SelectYear extends React.Component{
    render(){
        return <select className="form-control" id="selectYear" style={{width:100,float:'left'}}>
            <option value="2017">2017</option>
            <option value="2016">2016</option>
            <option value="2015">2015</option>
            <option value="2014">2014</option>
            <option value="2013">2013</option>
        </select>
    }
}
ReactDOM.render(<SelectTime/>,document.getElementById('content'));


// class Graph extends React.Component{
//     render(){
//         return <div style={{width: 600, height: 400, background: 'red'}}>THIS IS Graph</div>
//     }
// }

// ReactDOM.render(<Graph/>,document.getElementById('graph'));