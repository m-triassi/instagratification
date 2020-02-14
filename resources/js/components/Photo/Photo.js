import {
  Card, Icon, Row, Col, Input, Typography, message,
} from 'antd'
import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import { likePhoto, commentPhoto } from '../services/index'

const { Meta } = Card
const Photo = (props) => {
  const {
    media, id, caption, author, comments,
  } = props.post
  if (!id) return
  const [isCommentInputVisible, setIsCommentInputVisible] = useState(false)
  const [isLiked, setIsLiked] = useState(false)
  const [likeCount, setLikedCount] = useState(0)
  const [comment, setComment] = useState('')
  const [isCommentExpanded, setIsCommentExpanded] = useState(false)
  // TODO: handle URL redirecting better instead of just replace URL (React Router?)
  const description = (
    <Row style={{ fontSize: 12 }}>
      <Row>
        <Typography.Text strong onClick={() => window.location.replace(`/user/${author.name}`)}>
          {author.name}
          {' '}
        </Typography.Text>
        <Typography.Text>{caption}</Typography.Text>
      </Row>
      <Row>
        <Typography.Text
          style={{ fontSize: 11, color: '#EABFB9' }}
          onClick={() => {
            if (!comments.legnth > 0) {
              window.location.replace(`/post/${id}`)
            } else setIsCommentExpanded(!isCommentExpanded)
          }}>
          {comments.length > 1 ? 'click here expand the comments' : 'click here to view the post'}
        </Typography.Text>
        {isCommentExpanded && comments.map((value) => (
          <Row style={{ fontSize: 9 }}>
            <Typography.Text strong onClick={() => window.location.replace(`/user/${value.author_id}`)}>
              {value.author_id}
              {' '}
            </Typography.Text>
            <Typography.Text>{value.comment}</Typography.Text>
          </Row>
        ))}
      </Row>
    </Row>
  )

  const handleComment = () => commentPhoto({ comment, author: author.id, postID: id })
    .then((response) => {
      if (response.data.success) {
        message.success('your comment has been added')
        setIsCommentInputVisible(false)
        setComment('')
      }
    })

  const handleLike = () => {
    likePhoto({ postID: id }).then((response) => {
      if (response.data.success) {
        setLikedCount(likeCount + 1)
        setIsLiked(true)
      }
    })
  }

  return (
    <Card
      hoverable
      style={{ backgroundColor: '#F5F5F5', width: 512, marginBottom: 15 }}
      cover={<img style={{ padding: 20, aspectRatio: 3 / 2 }} src={media} />}>
      <Row gutter={16} style={{ marginTop: -40, paddingBottom: 10 }}>
        <Col span={1}>
          <Icon type='heart' theme={(isLiked) ? 'filled' : null} onClick={handleLike} />
        </Col>
        {likeCount > 0
            && <Col span={1}>
              <Typography.Text style={{ fontSize: 10 }}>{likeCount}</Typography.Text>
            </Col>}
        <Col span={1}>
          <Icon type='message' onClick={() => setIsCommentInputVisible(!isCommentInputVisible)} />
        </Col>
      </Row>
      <Meta description={description} />
      {isCommentInputVisible
                && <Row style={{ marginTop: 10 }}>
                  <Input
                    value={comment}
                    placeholder='insert your comment'
                    onChange={(value) => setComment(value.target.value)}
                    onBlur={() => setIsCommentInputVisible(false)}
                    onPressEnter={handleComment} />
                </Row>}
    </Card>
  )
}

Photo.displayName = 'Photo'
export default Photo
const elements = Array.from(document.getElementsByClassName('photo'))
if (elements) {
  const post = []
  elements.map((component) => {
    post.push(<Photo post={JSON.parse(component.getAttribute('post'))} />)
  })
  ReactDOM.render(post, document.getElementById('photo-container'))
}
