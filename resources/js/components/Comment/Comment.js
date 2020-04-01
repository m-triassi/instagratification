import React from 'react'
import {Row, Typography} from 'antd'

const Comment = (props) => {
  const {author, comment} = props
  const {name} = author
  return (
    <Row style={{fontSize: 9}}>
      <a href={`/user/${name}`}>
        <Typography.Text strong>
          {name}
          {' '}
        </Typography.Text>
      </a>
      <Typography.Text>{comment}</Typography.Text>
    </Row>
  )
}

export default Comment
Comment.displayName = 'Comment'
