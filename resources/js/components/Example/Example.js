import React from 'react'
import ReactDOM from 'react-dom'
import {Button} from 'antd'

const Example = () => (
  <Button type='primary'>This is an antd test Button</Button>
)

Example.displayName = 'Example'
export default Example

if (document.getElementById('example')) {
  ReactDOM.render(<Example />, document.getElementById('example'))
}
