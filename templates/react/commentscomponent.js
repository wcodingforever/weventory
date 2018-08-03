// import React from 'react'
// import NewComment from './newcomment'
// import AllComments from './allcomments'

class CommentsComponent extends React.Component {
    constructor(){
        super()
        this.state = {
            comments: []
        }
    }
    

    //idk if this works yet but when i can try it i will take it form there
    // componentDidMount() {
    //     fetch('../backend/comments.php')
    //     .then (gotThis => gotThis.json())
    //     .then (
    //         (result) => {
    //             this.setState({
    //                 comment: result.comments,
    //                 user: result.user_name,
    //                 id: result.id,
    //                 date: result.date
    //             })
    //         }
    //     )
    // }
    
    render() {
        return(
            <div>
                <NewComment addComment={this.addComment}/>
                <AllComments commentsArray={this.state.comments} addComment={this.addComment} deleteFunc={this.deleteFunc} editHandler={this.editHandler}/>
            </div>
        )
    }

    //gets the object from the new comment and updates state populating the array with the comments as objects 
    addComment = (incomingObj) => {
        let index = incomingObj.index
        this.setState({
            comments: [...this.state.comments, incomingObj],
            comment: incomingObj.comment
        })
    }


    deleteFunc = (obj) => {
        let index = obj
        console.log(index, "index here")
            var comments = this.state.comments
            comments.splice(index, 1)

        this.setState({
            ...this.state,
            comments: comments
        })
    }

    editHandler = (newIncomingObj, index) => {
        // console.log(newIncomingObj, index, "please work ")
        // console.log(index, "index coming in")
        
        var newArray = this.state.comments
        newArray.splice(index, 1, newIncomingObj)
        this.setState({
            ...this.state,
            comments: newArray,
        })
        // console.log(newArray, "new array")
    }

}


// export default CommentsComponent


