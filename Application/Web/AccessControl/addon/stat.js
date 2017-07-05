'use strict';

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactDom = require('react-dom');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var SelectTime = _react2.default.createClass({
    displayName: 'SelectTime',

    getInitialState: function getInitialState() {
        return { value: 'year' };
    },
    handleChang: function handleChang(e) {
        this.setState({ value: e.target.value });
    },
    render: function render() {
        var a = this.state.value;
        if (a == 'Year') console.log('Year');
        if (a == 'Month') console.log('Month');
        if (a == 'Day') console.log('Month');
        return _react2.default.createElement(
            'div',
            null,
            _react2.default.createElement(
                'select',
                { className: 'form-control', style: { width: 100, float: 'left' }, value: this.state.value, onChange: this.handleChang },
                _react2.default.createElement(
                    'option',
                    { value: 'Day' },
                    'Day'
                ),
                _react2.default.createElement(
                    'option',
                    { value: 'Month' },
                    'Month'
                ),
                _react2.default.createElement(
                    'option',
                    { value: 'Year' },
                    'Year'
                )
            ),
            _react2.default.createElement(Calendar, null),
            this.state.value
        );
    }
});

var Calendar = _react2.default.createClass({
    displayName: 'Calendar',

    render: function render() {
        return _react2.default.createElement(
            'button',
            { className: 'btn btn-info', id: 'btncal' },
            _react2.default.createElement('i', { className: 'glyph-icon icon-calendar' })
        );
    }
});

ReactDOM.render(_react2.default.createElement(SelectTime, null), document.getElementById('content'));
