import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import { Card, Icon, Row, Col, Input, Typography } from 'antd'

const { Meta } = Card
const Photo = (props) => {
    // Comments for massimo to attempt passing props from php files
    // parse JSON string from .blade.php
    // const photoProps = JSON.parse(props)
    // deconstruct props
    // const { photoURL, postID, caption } = photoProps

    // if (!postID) return
    const [isCommentInputVisible, setIsCommentInputVisible] = useState(false)
    const [isLiked, setIsLiked] = useState(false)

    // TODO: better practice to redirect to page? not sure

    const description = (
        <Row style={{ fontSize: 12 }}>
            <Row>
                <Typography.Text strong>username</Typography.Text>
                <Typography.Text> this is a test description</Typography.Text>
            </Row>
            <Row>
                <Typography.Text style={{ fontSize: 10, color: '#F6CFCA' }} onClick={() => window.location.replace(`/post/${postID}`)}>
                    Click here to expand comments
                </Typography.Text>
            </Row>
        </Row>
    )

    // TODO: fixed width and height with correct aspect ratio? 
    return (
        <Card hoverable
            style={{ width: 512 }}
            cover={<img style={{ padding: 20, aspectRatio: 3 / 2 }} src={'http://source.unsplash.com/random'} />}>
            <Row gutter={16} style={{ marginTop: -40, paddingBottom: 10 }}>
                <Col span={1}>
                    <Icon type='heart' theme={(isLiked) ? 'filled' : null} onClick={() => setIsLiked(!isLiked)} />
                </Col>
                <Col span={1}>
                    <Icon type='message' onClick={() => setIsCommentInputVisible(!isCommentInputVisible)} />
                </Col>
            </Row>
            <Meta description={description} />
            {isCommentInputVisible && <Row style={{ marginTop: 10 }}><Input placeholder='insert your comment' onBlur={() => setIsCommentInputVisible(false)} /></Row>}
        </Card>
    )
}

Photo.displayName = 'Photo'
export default Photo

if (document.getElementById('photo')) {
    ReactDOM.render(<Photo />, document.getElementById('photo'))
}
